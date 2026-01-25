<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'type',
        'herb_id',
        'product_stock_id',
        'capsule_id',
        'category_id',
        'employee_id',
        'quantity',
        'unit_price',
        'total_cost',
        'commande_id',
        'expense_date',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'decimal:3',
        'unit_price' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'expense_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    public function herb()
    {
        return $this->belongsTo(Herb::class);
    }

    public function productStock()
    {
        return $this->belongsTo(ProductStock::class);
    }

    public function capsule()
    {
        return $this->belongsTo(Capsule::class);
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employee_id');
    }

    /**
     * Create an expense record
     */
    public static function recordExpense($type, $quantity, $unitPrice, $commande = null, $herb = null, $productStock = null, $capsule = null, $notes = null)
    {
        return self::create([
            'type' => $type,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_cost' => $quantity * $unitPrice,
            'commande_id' => $commande ? $commande->id : null,
            'herb_id' => $herb ? $herb->id : null,
            'product_stock_id' => $productStock ? $productStock->id : null,
            'capsule_id' => $capsule ? $capsule->id : null,
            'expense_date' => now()->toDateString(),
            'notes' => $notes,
        ]);
    }
}
