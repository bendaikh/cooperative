<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommandeTicket extends Model
{
    use HasFactory;

    protected $table = 'commande_tickets';
    protected $fillable = ['commande_id', 'product_stock_id', 'quantity', 'ticket_type', 'nom_marque', 'numero_autorisation'];

    protected $casts = [
        'ticket_type' => 'string',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function productStock()
    {
        return $this->belongsTo(ProductStock::class);
    }
}
