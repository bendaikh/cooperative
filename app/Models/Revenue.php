<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable = [
        'commande_id',
        'cost',
        'selling_price',
        'margin',
        'margin_percentage',
        'status',
        'revenue_date',
        'notes',
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'margin' => 'decimal:2',
        'margin_percentage' => 'decimal:2',
        'revenue_date' => 'date',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    /**
     * Calculate margin and margin percentage
     */
    public function calculateMargin()
    {
        if ($this->selling_price && $this->cost) {
            $this->margin = $this->selling_price - $this->cost;
            if ($this->cost > 0) {
                $this->margin_percentage = ($this->margin / $this->cost) * 100;
            }
        }
    }

    /**
     * Create or update revenue record for a commande
     */
    public static function syncForCommande($commande)
    {
        // Find or create revenue record
        $revenue = self::where('commande_id', $commande->id)->firstOrCreate(
            ['commande_id' => $commande->id],
            ['status' => 'draft']
        );

        // Calculate total cost from expenses
        $totalCost = Expense::where('commande_id', $commande->id)->sum('total_cost');
        $revenue->cost = $totalCost;
        $revenue->calculateMargin();
        $revenue->save();

        return $revenue;
    }
}
