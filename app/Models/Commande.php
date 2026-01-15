<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'product_stock_id', 'quantity', 'status', 'notes', 'capsules_per_unit', 'avec_joint_securite', 'stock_applied', 'avec_ticket', 'nom_marque', 'numero_autorisation', 'ticket_product_stock_id', 'ticket_quantity'];

    protected $casts = [
        'quantity' => 'integer',
        'capsules_per_unit' => 'integer',
        'avec_joint_securite' => 'boolean',
        'stock_applied' => 'boolean',
        'avec_ticket' => 'boolean',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function productStock()
    {
        return $this->belongsTo(ProductStock::class);
    }

    // New relationships for packaging management
    public function emballages()
    {
        return $this->hasMany(CommandeEmballage::class);
    }

    public function filledCapsules()
    {
        return $this->hasMany(CommandeFilledCapsule::class);
    }

    public function tickets()
    {
        return $this->hasMany(CommandeTicket::class);
    }

    public function ticketStock()
    {
        return $this->belongsTo(ProductStock::class, 'ticket_product_stock_id');
    }

    public function revenue()
    {
        return $this->hasOne(Revenue::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Check if commande is in a status that allows stock/financial operations
     */
    public function isInProductionStatus()
    {
        return $this->status === 'En cours d\'emballage';
    }

    /**
     * Check if commande can have preview calculations
     */
    public function canPreviewCalculations()
    {
        return true; // Always allow preview
    }

    /**
     * Apply stock deductions (only when status changes to "En cours d'emballage")
     */
    public function applyStockDeductions()
    {
        if ($this->stock_applied || !$this->isInProductionStatus()) {
            return false;
        }

        // The actual stock deductions are now handled in updateStatus() controller
        // This method just sets the flag to prevent double-deduction
        
        // Mark as applied
        $this->stock_applied = true;
        $this->save();

        // Sync revenue
        Revenue::syncForCommande($this);

        return true;
    }

    public static function getStatuses()
    {
        return ['Confirmé', 'En cours d\'emballage', 'Sortie'];
    }


    
}

