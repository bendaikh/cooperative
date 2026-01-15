<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 'product_stock';
    
    protected $fillable = ['product_id', 'category_id', 'color_id', 'size_id', 'quantity', 'purchase_price', 'notes', 'fornisseur_id'];

    protected $casts = [
        'purchase_price' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function fornisseur()
    {
        return $this->belongsTo(Fornisseur::class);
    }

    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * Get the global quantity (simply return the base quantity)
     * 
     * Note: The base quantity is already updated via decrement/increment operations.
     * Stock movements are created for audit/tracking purposes but should NOT be
     * applied to the calculation since they would double-count the changes.
     */
    public function getGlobalQuantityAttribute()
    {
        return max(0, $this->quantity);
    }
}
