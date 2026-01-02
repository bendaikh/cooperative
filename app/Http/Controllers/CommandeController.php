<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeEmballage;
use App\Models\CommandeFilledCapsule;
use App\Models\Client;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\FilledCapsule;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::with([
                'client',
                'emballages.productStock.product',
                'filledCapsules.filledCapsule'
            ])
            ->latest()
            ->get();
        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('name')->get();
        
        // Get PILULIER products with their stock and movements for accurate quantity calculation
        $piluliers = Product::where('type_emballage', 'PILULIER')
            ->with('stock.movements')
            ->get();
        
        // Get BOUCHON products with their stock and movements for accurate quantity calculation
        $bouchons = Product::where('type_emballage', 'BOUCHON')
            ->with('stock.movements')
            ->get();
        
        // Get Joint de sécurité stock with movements for accurate quantity calculation
        $jointSecurite = Product::where('name', 'Joint de sécurité')
            ->with('stock.movements')
            ->first();
        
        // Get filled capsules for selection
        $filledCapsules = FilledCapsule::with(['herb', 'capsule'])->get();
        
        // Capsules per unit options
        $capsulesPerUnitOptions = [30, 60, 90, 120];
        
        return view('commandes.create', compact(
            'clients',
            'piluliers',
            'bouchons',
            'jointSecurite',
            'filledCapsules',
            'capsulesPerUnitOptions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('COMMANDE STORE: Request received', $request->all());
        
        // Validation
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'quantity' => 'required|integer|min:1',
            'capsules_per_unit' => 'required|integer|in:30,60,90,120',
            'pilulier_product_stock_id' => 'required|exists:product_stock,id',
            'bouchon_product_stock_id' => 'required|exists:product_stock,id',
            'filled_capsule_id' => 'required|exists:filled_capsules,id',
            'avec_joint_securite' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ]);
        
        \Log::info('COMMANDE STORE: Validation passed', $validated);

        try {
            DB::beginTransaction();
            \Log::info('COMMANDE STORE: Transaction started');

            \Log::info('COMMANDE STORE: Request quantity raw', ['raw_quantity' => $request->quantity, 'type' => gettype($request->quantity)]);
            
            $quantity = $request->quantity;
            $capsulesPerUnit = $request->capsules_per_unit;
            $totalCapsulesNeeded = $quantity * $capsulesPerUnit;
            
            \Log::info('COMMANDE STORE: After assignment', ['quantity' => $quantity, 'type' => gettype($quantity)]);
            
            // EXPLICIT CAST TO ENSURE QUANTITY IS CORRECT
            $quantity = (int) $quantity;
            
            \Log::info('COMMANDE STORE: Variables set', [
                'quantity_from_request' => $request->quantity,
                'quantity_cast_to_int' => $quantity,
                'quantity_type' => gettype($quantity),
                'capsules_per_unit' => $capsulesPerUnit,
                'total_capsules_needed' => $totalCapsulesNeeded
            ]);

            // Get product stocks
            $pilulierStock = ProductStock::findOrFail($request->pilulier_product_stock_id);
            $bouchonStock = ProductStock::findOrFail($request->bouchon_product_stock_id);
            $filledCapsule = FilledCapsule::findOrFail($request->filled_capsule_id);
            \Log::info('COMMANDE STORE: Stock records found');

            // Verify products are correct type
            if ($pilulierStock->product->type_emballage !== 'PILULIER') {
                throw new \Exception('Le stock sélectionné pour PILULIER est invalide.');
            }
            if ($bouchonStock->product->type_emballage !== 'BOUCHON') {
                throw new \Exception('Le stock sélectionné pour BOUCHON est invalide.');
            }
            \Log::info('COMMANDE STORE: Product types verified');

            // Check stock availability
            $validator = Validator::make([], []);
            
            if ($quantity > $pilulierStock->quantity) {
                \Log::warning('COMMANDE STORE: PILULIER stock insufficient');
                $validator->errors()->add('pilulier_product_stock_id', 'Stock PILULIER insuffisant. Disponible: ' . $pilulierStock->quantity);
            }
            if ($quantity > $bouchonStock->quantity) {
                \Log::warning('COMMANDE STORE: BOUCHON stock insufficient');
                $validator->errors()->add('bouchon_product_stock_id', 'Stock BOUCHON insuffisant. Disponible: ' . $bouchonStock->quantity);
            }
            // Convert filled_capsule quantity (in rangées) to capsules for comparison
            $availableCapsules = $filledCapsule->quantity * 420; // 1 rangée = 420 capsules
            if ($totalCapsulesNeeded > $availableCapsules) {
                \Log::warning('COMMANDE STORE: Capsules insufficient');
                $capsuleAvailable = round($filledCapsule->quantity * 420);
                $validator->errors()->add('filled_capsule_id', 'Quantité de capsules insuffisante. Disponible: ' . $capsuleAvailable . ' capsules');
            }
            
            // Check Joint de sécurité stock if requested
            $jointSecuriteStock = null;
            if ($request->avec_joint_securite) {
                $jointSecuriteProduct = Product::where('name', 'Joint de sécurité')->first();
                if (!$jointSecuriteProduct) {
                    $validator->errors()->add('avec_joint_securite', 'Le produit "Joint de sécurité" n\'existe pas dans la base de données.');
                }
                else {
                    $jointSecuriteStock = $jointSecuriteProduct->stock()->first();
                    if (!$jointSecuriteStock) {
                        $validator->errors()->add('avec_joint_securite', 'Aucun stock trouvé pour "Joint de sécurité".');
                    } elseif ($quantity > $jointSecuriteStock->quantity) {
                        $validator->errors()->add('avec_joint_securite', 'Stock Joint de sécurité insuffisant. Disponible: ' . $jointSecuriteStock->quantity);
                    }
                }
            }
            
            // If there are validation errors, throw them
            if ($validator->errors()->any()) {
                throw new ValidationException($validator);
            }
            
            \Log::info('COMMANDE STORE: Stock availability verified');

            // Create commande
            \Log::info('COMMANDE STORE: About to create commande', [
                'client_id' => $request->client_id,
                'product_stock_id' => $request->pilulier_product_stock_id,
                'quantity' => $quantity,
                'capsules_per_unit' => $capsulesPerUnit,
                'status' => 'Confirmé',
                'notes' => $request->notes,
            ]);
            
            $commande = Commande::create([
                'client_id' => $request->client_id,
                'product_stock_id' => $request->pilulier_product_stock_id, // Reference to main stock
                'quantity' => $quantity,
                'capsules_per_unit' => $capsulesPerUnit,
                'status' => 'Confirmé',
                'avec_joint_securite' => $request->avec_joint_securite ?? false,
                'notes' => $request->notes,
            ]);
            
            \Log::info('COMMANDE STORE: Commande created', ['id' => $commande->id, 'client_id' => $commande->client_id]);

            // Create emballage records (PILULIER and BOUCHON)
            \Log::info('COMMANDE STORE: Creating emballages', [
                'quantity' => $quantity,
                'quantity_int_casted' => (int)$quantity,
                'with_joint_securite' => $request->avec_joint_securite ?? false,
            ]);
            
            // Log stock BEFORE creating emballages
            $pilulierStock->refresh();
            $bouchonStock->refresh();
            \Log::info('COMMANDE STORE: Stock before creating emballages', [
                'pilulier_stock_qty' => $pilulierStock->quantity,
                'bouchon_stock_qty' => $bouchonStock->quantity,
            ]);
            
            // Track created emballages to prevent duplicates
            $createdProductStockIds = [];
            
            // Create PILULIER emballage
            if (!isset($createdProductStockIds[$request->pilulier_product_stock_id])) {
                $pilulierEmb = CommandeEmballage::create([
                    'commande_id' => $commande->id,
                    'product_stock_id' => $request->pilulier_product_stock_id,
                    'quantity' => (int)$quantity,
                ]);
                \Log::info('COMMANDE STORE: PILULIER emballage created', [
                    'quantity' => $pilulierEmb->quantity,
                    'quantity_type' => gettype($pilulierEmb->quantity),
                ]);
                $createdProductStockIds[$request->pilulier_product_stock_id] = true;
            } else {
                \Log::warning('COMMANDE STORE: Skipping duplicate PILULIER emballage');
            }
            
            // Log stock AFTER creating PILULIER emballage
            $pilulierStock->refresh();
            \Log::info('COMMANDE STORE: Stock after PILULIER emballage', [
                'pilulier_stock_qty' => $pilulierStock->quantity,
            ]);

            // Create BOUCHON emballage
            if (!isset($createdProductStockIds[$request->bouchon_product_stock_id])) {
                $bouchonEmb = CommandeEmballage::create([
                    'commande_id' => $commande->id,
                    'product_stock_id' => $request->bouchon_product_stock_id,
                    'quantity' => (int)$quantity,
                ]);
                \Log::info('COMMANDE STORE: BOUCHON emballage created', [
                    'quantity' => $bouchonEmb->quantity,
                    'quantity_type' => gettype($bouchonEmb->quantity),
                ]);
                $createdProductStockIds[$request->bouchon_product_stock_id] = true;
            } else {
                \Log::warning('COMMANDE STORE: Skipping duplicate BOUCHON emballage');
            }
            
            // Log stock AFTER creating BOUCHON emballage
            $bouchonStock->refresh();
            \Log::info('COMMANDE STORE: Stock after BOUCHON emballage', [
                'bouchon_stock_qty' => $bouchonStock->quantity,
            ]);
            
            // Add Joint de sécurité if checked
            if ($request->avec_joint_securite && $jointSecuriteStock) {
                \Log::info('COMMANDE STORE: Adding Joint de sécurité', [
                    'commande_id' => $commande->id,
                    'joint_stock_id' => $jointSecuriteStock->id,
                    'quantity' => (int)$quantity,
                ]);
                
                if (!isset($createdProductStockIds[$jointSecuriteStock->id])) {
                    $jointSecuriteStock->refresh();
                    \Log::info('COMMANDE STORE: Stock before Joint emballage', [
                        'joint_stock_qty' => $jointSecuriteStock->quantity,
                    ]);
                    
                    $jointEmb = CommandeEmballage::create([
                        'commande_id' => $commande->id,
                        'product_stock_id' => $jointSecuriteStock->id,
                        'quantity' => (int)$quantity,
                    ]);
                    \Log::info('COMMANDE STORE: Joint emballage created', [
                        'quantity' => $jointEmb->quantity,
                        'quantity_type' => gettype($jointEmb->quantity),
                    ]);
                    $createdProductStockIds[$jointSecuriteStock->id] = true;
                    
                    $jointSecuriteStock->refresh();
                    \Log::info('COMMANDE STORE: Stock after Joint emballage', [
                        'joint_stock_qty' => $jointSecuriteStock->quantity,
                    ]);
                } else {
                    \Log::warning('COMMANDE STORE: Skipping duplicate Joint emballage');
                }
            }

            // Create filled capsule record
            CommandeFilledCapsule::create([
                'commande_id' => $commande->id,
                'filled_capsule_id' => $request->filled_capsule_id,
                'quantity' => $totalCapsulesNeeded,
            ]);

            // Stock deduction will happen when status changes to "En cours d'emballage"
            // No stock movement on creation (status = Confirmé)
            
            \Log::info('COMMANDE STORE: Stock decremented', [
                'pilulier_decrement' => $quantity,
                'bouchon_decrement' => $quantity,
                'capsules_decrement' => $totalCapsulesNeeded
            ]);
            
            DB::commit();

            \Log::info('COMMANDE STORE: SUCCESS - Commande created with ID: ' . $commande->id);

            return redirect()->route('commandes.index')
                ->with('success', 'Commande créée avec succès. PILULIER: ' . $quantity . 'x, BOUCHON: ' . $quantity . 'x, Capsules: ' . $totalCapsulesNeeded . 'x');

        } catch (\Exception $e) {
            \Log::error('COMMANDE STORE: ERROR - ' . $e->getMessage(), ['exception' => $e]);
            DB::rollBack();
            return back()->withErrors(['error' => 'Erreur lors de la création: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        $commande->load([
            'client',
            'emballages.productStock.product',
            'filledCapsules.filledCapsule.herb'
        ]);
        return view('commandes.show', compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        $commande->load([
            'client',
            'emballages.productStock.product',
            'filledCapsules.filledCapsule'
        ]);
        
        $clients = Client::orderBy('name')->get();
        
        // Get PILULIER products with their stock and movements for accurate quantity calculation
        $piluliers = Product::where('type_emballage', 'PILULIER')
            ->with('stock.movements')
            ->get();
        
        // Get BOUCHON products with their stock and movements for accurate quantity calculation
        $bouchons = Product::where('type_emballage', 'BOUCHON')
            ->with('stock.movements')
            ->get();
        
        // Get Joint de sécurité stock with movements for accurate quantity calculation
        $jointSecurite = Product::where('name', 'Joint de sécurité')
            ->with('stock.movements')
            ->first();
        
        // Get filled capsules for selection
        $filledCapsules = FilledCapsule::with(['herb', 'capsule'])->get();
        
        // Capsules per unit options
        $capsulesPerUnitOptions = [30, 60, 90, 120];
        
        return view('commandes.edit', compact(
            'commande',
            'clients',
            'piluliers',
            'bouchons',
            'jointSecurite',
            'filledCapsules',
            'capsulesPerUnitOptions'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'quantity' => 'required|integer|min:1',
            'capsules_per_unit' => 'required|integer|in:30,60,90,120',
            'pilulier_product_stock_id' => 'required|exists:product_stock,id',
            'bouchon_product_stock_id' => 'required|exists:product_stock,id',
            'filled_capsule_id' => 'required|exists:filled_capsules,id',
            'avec_joint_securite' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $oldQuantity = $commande->quantity;
            $oldCapsulesPerUnit = $commande->capsules_per_unit;
            $oldTotalCapsules = $oldQuantity * $oldCapsulesPerUnit;

            $newQuantity = $request->quantity;
            $newCapsulesPerUnit = $request->capsules_per_unit;
            $newTotalCapsules = $newQuantity * $newCapsulesPerUnit;

            // Only restore/deduct stock if status is "En cours d'emballage" or "Sortie"
            $hasStockBeenDeducted = in_array($commande->status, ['En cours d\'emballage', 'Sortie']);

            if ($hasStockBeenDeducted) {
                // Get new stocks
                $newPilulierStock = ProductStock::findOrFail($request->pilulier_product_stock_id);
                $newBouchonStock = ProductStock::findOrFail($request->bouchon_product_stock_id);
                $newFilledCapsule = FilledCapsule::findOrFail($request->filled_capsule_id);

                // Verify products are correct type
                if ($newPilulierStock->product->type_emballage !== 'PILULIER') {
                    throw new \Exception('Le stock sélectionné pour PILULIER est invalide.');
                }
                if ($newBouchonStock->product->type_emballage !== 'BOUCHON') {
                    throw new \Exception('Le stock sélectionné pour BOUCHON est invalide.');
                }

                // Get old emballages
                $oldEmballages = $commande->emballages()->with('productStock')->get();
                $oldPilulierStock = null;
                $oldBouchonStock = null;

                foreach ($oldEmballages as $emballage) {
                    if ($emballage->productStock->product->type_emballage === 'PILULIER') {
                        $oldPilulierStock = $emballage->productStock;
                    } elseif ($emballage->productStock->product->type_emballage === 'BOUCHON') {
                        $oldBouchonStock = $emballage->productStock;
                    }
                }

                // Get old filled capsule
                $oldFilledCapsuleRecord = $commande->filledCapsules()->first();
                $oldFilledCapsule = $oldFilledCapsuleRecord ? $oldFilledCapsuleRecord->filledCapsule : null;

                // Restore old stock
                if ($oldPilulierStock) {
                    $oldPilulierStock->increment('quantity', $oldQuantity);
                    StockMovement::create([
                        'product_stock_id' => $oldPilulierStock->id,
                        'type' => 'restock',
                        'quantity' => $oldQuantity,
                        'movement_date' => now(),
                        'notes' => 'Commande #' . $commande->id . ' mise à jour - PILULIER',
                    ]);
                }

                if ($oldBouchonStock) {
                    $oldBouchonStock->increment('quantity', $oldQuantity);
                    StockMovement::create([
                        'product_stock_id' => $oldBouchonStock->id,
                        'type' => 'restock',
                        'quantity' => $oldQuantity,
                        'movement_date' => now(),
                        'notes' => 'Commande #' . $commande->id . ' mise à jour - BOUCHON',
                    ]);
                }

                if ($oldFilledCapsule) {
                    $oldFilledCapsule->increment('quantity', $oldTotalCapsules);
                }

                // Check new stock availability
                if ($newQuantity > $newPilulierStock->quantity) {
                    throw new \Exception('Stock PILULIER insuffisant. Disponible: ' . $newPilulierStock->quantity);
                }
                if ($newQuantity > $newBouchonStock->quantity) {
                    throw new \Exception('Stock BOUCHON insuffisant. Disponible: ' . $newBouchonStock->quantity);
                }
                if ($newTotalCapsules > $newFilledCapsule->quantity) {
                    throw new \Exception('Quantité de capsules insuffisante. Disponible: ' . $newFilledCapsule->quantity);
                }

                // Decrement new stock
                $newPilulierStock->decrement('quantity', $newQuantity);
                StockMovement::create([
                    'product_stock_id' => $request->pilulier_product_stock_id,
                    'type' => 'usage',
                    'quantity' => $newQuantity,
                    'movement_date' => now(),
                    'notes' => 'Commande #' . $commande->id . ' - PILULIER - ' . ($request->notes ?? ''),
                ]);

                $newBouchonStock->decrement('quantity', $newQuantity);
                StockMovement::create([
                    'product_stock_id' => $request->bouchon_product_stock_id,
                    'type' => 'usage',
                    'quantity' => $newQuantity,
                    'movement_date' => now(),
                    'notes' => 'Commande #' . $commande->id . ' - BOUCHON - ' . ($request->notes ?? ''),
                ]);

                $newFilledCapsule->decrement('quantity', $newTotalCapsules);
            }

            // Update commande
            $commande->update([
                'client_id' => $request->client_id,
                'quantity' => $newQuantity,
                'capsules_per_unit' => $newCapsulesPerUnit,
                'avec_joint_securite' => $request->avec_joint_securite ?? false,
                'notes' => $request->notes,
            ]);

            // Update emballages
            $commande->emballages()->delete();
            CommandeEmballage::create([
                'commande_id' => $commande->id,
                'product_stock_id' => $request->pilulier_product_stock_id,
                'quantity' => $newQuantity,
            ]);
            CommandeEmballage::create([
                'commande_id' => $commande->id,
                'product_stock_id' => $request->bouchon_product_stock_id,
                'quantity' => $newQuantity,
            ]);
            
            // Add Joint de sécurité if checked
            if ($request->avec_joint_securite) {
                $jointSecuriteProduct = Product::where('name', 'Joint de sécurité')->first();
                if ($jointSecuriteProduct) {
                    $jointSecuriteStock = $jointSecuriteProduct->stock()->first();
                    if ($jointSecuriteStock) {
                        CommandeEmballage::create([
                            'commande_id' => $commande->id,
                            'product_stock_id' => $jointSecuriteStock->id,
                            'quantity' => $newQuantity,
                        ]);
                    }
                }
            }

            // Update filled capsules
            $commande->filledCapsules()->delete();
            CommandeFilledCapsule::create([
                'commande_id' => $commande->id,
                'filled_capsule_id' => $request->filled_capsule_id,
                'quantity' => $newTotalCapsules,
            ]);

            DB::commit();

            return redirect()->route('commandes.index')
                ->with('success', 'Commande mise à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erreur lors de la mise à jour: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        try {
            DB::beginTransaction();

            /**
             * DELETION LOGIC WITH STOCK GUARD
             * 
             * The stock_applied flag determines if stock changes should be applied:
             * - If stock_applied = false: Stock was never deducted, don't change anything on delete
             * - If stock_applied = true: Stock was deducted, apply reductions on delete
             * 
             * Status mapping:
             * - "Confirmé": stock_applied is always false → no stock change
             * - "En cours d'emballage": stock_applied is true → apply reductions
             * - "Livrée"/"Sortie": stock_applied is true → apply reductions
             */

            if ($commande->status === 'Confirmé') {
                // Status: CONFIRMÉ
                // stock_applied must be false
                // Action: Do nothing to stock
                // Reason: No stock movements have been applied for this confirmed order
                
                \Log::info('COMMANDE DELETE: Status=Confirmé, no stock changes', [
                    'commande_id' => $commande->id,
                    'status' => $commande->status,
                    'stock_applied' => $commande->stock_applied
                ]);
                
            } elseif (in_array($commande->status, ['En cours d\'emballage', 'Livrée', 'Sortie'])) {
                // Status: EN COURS D'EMBALLAGE, LIVRÉE, or SORTIE
                // Check stock_applied flag before reducing
                
                if ($commande->stock_applied === false) {
                    // Stock was never applied, apply reductions now
                    \Log::info('COMMANDE DELETE: Applying stock reductions (stock_applied=false)', [
                        'commande_id' => $commande->id,
                        'status' => $commande->status,
                        'stock_applied' => false
                    ]);

                    // Reduce emballage stock (PILULIER, BOUCHON, and optionally Joint de sécurité)
                    $emballages = $commande->emballages()->with('productStock.product')->get();
                    
                    foreach ($emballages as $emballage) {
                        // Decrement the stock quantity
                        $emballage->productStock->decrement('quantity', $emballage->quantity);
                        
                        // Record the stock movement as a USAGE (consumption)
                        StockMovement::create([
                            'product_stock_id' => $emballage->product_stock_id,
                            'type' => 'usage',
                            'quantity' => $emballage->quantity,
                            'movement_date' => now(),
                            'notes' => 'Commande #' . $commande->id . ' supprimée - ' . $emballage->productStock->product->name,
                        ]);
                    }

                    // Reduce filled capsules stock
                    $filledCapsuleRecords = $commande->filledCapsules()->with('filledCapsule')->get();
                    foreach ($filledCapsuleRecords as $record) {
                        // Convert capsules to rangées (1 rangée = 420 capsules)
                        $rangeesNeeded = $record->quantity / 420;
                        $record->filledCapsule->decrement('quantity', $rangeesNeeded);
                    }

                } else {
                    // stock_applied is true, stock was already deducted
                    // Do nothing - stock reduction already happened when status changed
                    \Log::info('COMMANDE DELETE: Stock already applied, no additional changes', [
                        'commande_id' => $commande->id,
                        'status' => $commande->status,
                        'stock_applied' => true
                    ]);
                }
            }

            $commande->delete();
            
            DB::commit();

            return redirect()->route('commandes.index')
                ->with('success', 'Commande supprimée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('COMMANDE DELETE ERROR', [
                'commande_id' => $commande->id ?? null,
                'status' => $commande->status ?? null,
                'stock_applied' => $commande->stock_applied ?? null,
                'error' => $e->getMessage()
            ]);
            return back()->withErrors(['error' => 'Erreur lors de la suppression: ' . $e->getMessage()]);
        }
    }

    /**
     * Update commande status via AJAX
     * 
     * STOCK GUARD LOGIC:
     * - Uses stock_applied flag to prevent double-decrement
     * - Stock only decremented ONCE when transitioning to "En cours d'emballage"
     * - Flag prevents re-execution on status updates
     */
    public function updateStatus(Request $request, Commande $commande)
    {
        try {
            $validStatuses = ['Confirmé', 'En cours d\'emballage', 'Sortie'];
            $request->validate([
                'status' => ['required', Rule::in($validStatuses)],
            ]);

            $oldStatus = $commande->status;
            $newStatus = $request->status;

            // Cannot go to Sortie backwards (only forward progression allowed to Sortie)
            if ($oldStatus === 'Sortie') {
                return response()->json([
                    'success' => false,
                    'message' => 'Impossible de modifier une commande déjà sortie.'
                ], 400);
            }

            /**
             * GUARD: Only apply stock changes when transitioning to "En cours d'emballage"
             * AND stock_applied flag is still false (prevents double-decrement)
             */
            if ($newStatus === 'En cours d\'emballage' && !$commande->stock_applied) {
                DB::beginTransaction();
                
                try {
                    $commande->load('emballages.productStock', 'filledCapsules.filledCapsule');
                    
                    // Validate we have emballages to process
                    if ($commande->emballages->isEmpty()) {
                        DB::rollBack();
                        return response()->json([
                            'success' => false,
                            'message' => 'Aucun emballage trouvé pour cette commande'
                        ], 400);
                    }
                    
                    // Check stock availability for emballages
                    foreach ($commande->emballages as $emballage) {
                        if ($emballage->quantity > $emballage->productStock->quantity) {
                            DB::rollBack();
                            return response()->json([
                                'success' => false,
                                'message' => 'Stock insuffisant pour ' . $emballage->productStock->product->name
                            ], 400);
                        }
                    }

                    // Check stock availability for filled capsules (convert capsules to rangées for comparison)
                    foreach ($commande->filledCapsules as $record) {
                        $availableCapsules = $record->filledCapsule->quantity * 420; // Convert rangées to capsules
                        if ($record->quantity > $availableCapsules) {
                            DB::rollBack();
                            return response()->json([
                                'success' => false,
                                'message' => 'Stock de capsules remplies insuffisant'
                            ], 400);
                        }
                    }

                    // ✅ DECREMENT STOCK EXACTLY ONCE
                    \Log::info('COMMANDE UPDATE STATUS: Applying stock deductions', [
                        'commande_id' => $commande->id,
                        'stock_applied' => false,
                        'new_status' => $newStatus,
                        'quantity' => $commande->quantity,
                        'emballages_count' => $commande->emballages->count(),
                    ]);

                    // Track decremented products to prevent duplicates
                    $decrementedProducts = [];
                    
                    // Apply stock deductions for emballages (PILULIER, BOUCHON, and optionally Joint de sécurité)
                    foreach ($commande->emballages as $emballage) {
                        // Prevent duplicate decrements for the same product stock
                        if (isset($decrementedProducts[$emballage->product_stock_id])) {
                            \Log::warning('COMMANDE UPDATE STATUS: Skipping duplicate decrement', [
                                'commande_id' => $commande->id,
                                'product_stock_id' => $emballage->product_stock_id,
                                'product_name' => $emballage->productStock->product->name,
                            ]);
                            continue;
                        }
                        
                        \Log::info('COMMANDE UPDATE STATUS: Decrementing emballage', [
                            'commande_id' => $commande->id,
                            'product_name' => $emballage->productStock->product->name,
                            'emballage_quantity' => $emballage->quantity,
                            'product_stock_current_qty' => $emballage->productStock->quantity,
                        ]);
                        
                        $emballage->productStock->decrement('quantity', $emballage->quantity);
                        $decrementedProducts[$emballage->product_stock_id] = true;
                        
                        \Log::info('COMMANDE UPDATE STATUS: Stock movement created', [
                            'product_stock_id' => $emballage->product_stock_id,
                            'type' => 'usage',
                            'quantity' => $emballage->quantity,
                        ]);
                        
                        StockMovement::create([
                            'product_stock_id' => $emballage->product_stock_id,
                            'type' => 'usage',
                            'quantity' => $emballage->quantity,
                            'movement_date' => now(),
                            'notes' => 'Commande #' . $commande->id . ' - ' . $emballage->productStock->product->name,
                        ]);
                    }

                    // Decrement filled capsules stock
                    foreach ($commande->filledCapsules as $record) {
                        // Convert capsules to rangées (1 rangée = 420 capsules)
                        $rangeesNeeded = $record->quantity / 420;
                        $record->filledCapsule->decrement('quantity', $rangeesNeeded);
                    }

                    // ✅ SET GUARD FLAG to prevent re-execution
                    $commande->update([
                        'status' => $newStatus,
                        'stock_applied' => true
                    ]);

                    DB::commit();

                } catch (\Exception $e) {
                    DB::rollBack();
                    \Log::error('COMMANDE UPDATE STATUS ERROR', [
                        'commande_id' => $commande->id,
                        'error' => $e->getMessage()
                    ]);
                    throw $e;
                }
            } else {
                // No stock changes for "Confirmé" or when stock_applied is already true
                if ($newStatus === 'En cours d\'emballage' && $commande->stock_applied) {
                    \Log::info('COMMANDE UPDATE STATUS: Stock already applied, skipping', [
                        'commande_id' => $commande->id,
                        'stock_applied' => true
                    ]);
                }
                $commande->update(['status' => $newStatus]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès.',
                'status' => $newStatus
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }
}

