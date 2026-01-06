<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'type_emballage'];

    protected $casts = [
        'type_emballage' => 'string',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function stock()
    {
        return $this->hasMany(ProductStock::class);
    }

    // Check if this is packaging (has type_emballage)
    public function isEmballage()
    {
        return !is_null($this->type_emballage) || $this->name === 'Joint de sécurité';
    }

    // Get type of emballage (generic - no pilulier/bouchon separation)
    public function getTypeEmballageLabel()
    {
        if ($this->name === 'Joint de sécurité') {
            return '🔒 Joint de sécurité';
        }
        
        if ($this->name === 'Ticket') {
            return '🎫 Ticket';
        }
        
        // For generic emballage products, return a generic label
        return !is_null($this->type_emballage) ? '📦 Emballage' : '';
    }
}

