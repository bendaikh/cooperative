<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'product_stock_id', 'quantity', 'status', 'notes', 'capsules_per_unit', 'avec_joint_securite', 'stock_applied'];

    protected $casts = [
        'quantity' => 'integer',
        'capsules_per_unit' => 'integer',
        'avec_joint_securite' => 'boolean',
        'stock_applied' => 'boolean',
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

    public static function getStatuses()
    {
        return ['Confirmé', 'En cours d\'emballage', 'Sortie'];
    }


    
}

