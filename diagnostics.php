<?php
require 'bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Commande;
use App\Models\ProductStock;
use App\Models\StockMovement;

echo "=== DIAGNOSTIC REPORT ===\n\n";

// Get the latest commande
$latestCommande = Commande::latest('id')->first();

if (!$latestCommande) {
    echo "No commandes found\n";
    exit(1);
}

echo "Latest Commande: #" . $latestCommande->id . "\n";
echo "Quantity: " . $latestCommande->quantity . "\n";
echo "Status: " . $latestCommande->status . "\n";
echo "stock_applied: " . ($latestCommande->stock_applied ? 'TRUE' : 'FALSE') . "\n\n";

// Check emballages
echo "=== EMBALLAGES ===\n";
$latestCommande->load('emballages.productStock.product');
foreach ($latestCommande->emballages as $emb) {
    echo "Product: " . $emb->productStock->product->name . "\n";
    echo "  Emballage Quantity: " . $emb->quantity . "\n";
    echo "  ProductStock ID: " . $emb->productStock->id . "\n";
    echo "  Current Stock (quantity field): " . $emb->productStock->quantity . "\n";
    
    // Check stock movements
    $movements = StockMovement::where('product_stock_id', $emb->productStock->id)
        ->where('notes', 'like', '%Commande #' . $latestCommande->id . '%')
        ->get();
    
    echo "  Stock Movements for this commande: " . $movements->count() . "\n";
    foreach ($movements as $mov) {
        echo "    - Type: " . $mov->type . ", Qty: " . $mov->quantity . ", Date: " . $mov->created_at . "\n";
    }
    
    // Calculate global_quantity manually
    $restocks = StockMovement::where('product_stock_id', $emb->productStock->id)
        ->where('type', 'restock')->sum('quantity');
    $usages = StockMovement::where('product_stock_id', $emb->productStock->id)
        ->where('type', 'usage')->sum('quantity');
    $globalQty = ($emb->productStock->quantity ?? 0) + $restocks - $usages;
    
    echo "  Global Quantity Calculation: " . $emb->productStock->quantity . " + " . $restocks . " - " . $usages . " = " . $globalQty . "\n\n";
}
