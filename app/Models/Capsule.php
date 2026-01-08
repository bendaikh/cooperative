<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capsule extends Model
{
    protected $fillable = ['carton', 'quantity', 'nombre_capsules', 'carton_type_id', 'carton_price', 'notes'];

    protected $casts = [
        'carton_price' => 'decimal:2',
    ];

    /**
     * Relationship to CartonType
     */
    public function cartonType()
    {
        return $this->belongsTo(CartonType::class);
    }

    public function movements()
    {
        return $this->hasMany(CapsuleStockMovement::class);
    }

    public function filledCapsules()
    {
        return $this->hasMany(FilledCapsule::class);
    }

    /**
     * Calculate the global quantity based on movements
     */
    public function getGlobalQuantityAttribute()
    {
        // Use eager-loaded relationship if available, otherwise query
        if ($this->relationLoaded('movements')) {
            $restocks = $this->movements->where('type', 'restock')->sum('quantity');
            $usages = $this->movements->where('type', 'usage')->sum('quantity');
        } else {
            $restocks = $this->movements()->where('type', 'restock')->sum('quantity');
            $usages = $this->movements()->where('type', 'usage')->sum('quantity');
        }
        return ($this->quantity ?? 0) + $restocks - $usages;
    }

    /**
     * Calculate remaining cartons based on nombre_capsules
     * 1 carton = 125,000 capsules
     */
    public function getRemainingCartonsAttribute()
    {
        return intval(floor($this->nombre_capsules / 125000));
    }

    /**
     * Get carton status
     * If nombre_capsules < 125000 → "Carton ouvert"
     * Otherwise → number of full cartons
     */
    public function getCartonStatusAttribute()
    {
        if ($this->nombre_capsules < 125000 && $this->nombre_capsules > 0) {
            return 'Carton ouvert';
        }
        return $this->remaining_cartons;
    }

    /**
     * Get capsules per carton based on carton type
     */
    public function getCapsulesPerCarton()
    {
        if ($this->cartonType) {
            return $this->cartonType->capacity;
        }
        // Fallback to default Type A (125000)
        return 125000;
    }

    /**
     * Calculate nombre_capsules from quantity (cartons) and carton type
     */
    public static function calculateNombreCapsules($quantity, $cartonTypeId)
    {
        $cartonType = CartonType::find($cartonTypeId);
        $capacity = $cartonType ? $cartonType->capacity : 125000;
        return $quantity * $capacity;
    }

    /**
     * Boot the model to set nombre_capsules when creating/updating
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->nombre_capsules && $model->quantity && $model->carton_type_id) {
                $cartonType = CartonType::find($model->carton_type_id);
                $capacity = $cartonType ? $cartonType->capacity : 125000;
                $model->nombre_capsules = $model->quantity * $capacity;
            }
        });

        static::updating(function ($model) {
            // Only recalculate nombre_capsules if carton_type_id changed, NOT if only quantity changed
            // (quantity is recalculated FROM nombre_capsules after usage, not the other way around)
            if ($model->isDirty('carton_type_id') && $model->carton_type_id) {
                $cartonType = CartonType::find($model->carton_type_id);
                $capacity = $cartonType ? $cartonType->capacity : 125000;
                $model->nombre_capsules = $model->quantity * $capacity;
            }
        });
    }
}
