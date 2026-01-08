<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartonType extends Model
{
    protected $fillable = [
        'name',
        'capacity',
        'description',
        'purchase_price',
        'is_active'
    ];

    protected $casts = [
        'capacity' => 'integer',
        'purchase_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Get all capsules using this carton type
     */
    public function capsules()
    {
        return $this->hasMany(Capsule::class);
    }

    /**
     * Get all active carton types
     */
    public static function active()
    {
        return self::where('is_active', true)->orderBy('name')->get();
    }

    /**
     * Format carton type display (e.g., "Type A - 125,000 caps")
     */
    public function getDisplayNameAttribute()
    {
        return "{$this->name} - " . number_format($this->capacity, 0, ',', ' ') . " caps";
    }
}
