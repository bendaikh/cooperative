<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employes';

    protected $fillable = [
        'nom',
        'prenom',
        'poste',
        'type_contrat',
        'salaire',
        'salaire_type',
        'date_embauche',
        'telephone',
        'email',
        'adresse',
        'statut',
    ];

    protected $casts = [
        'salaire' => 'decimal:2',
        'date_embauche' => 'date',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'employee_id');
    }

    public function getNomCompletAttribute(): string
    {
        return trim("{$this->prenom} {$this->nom}");
    }
}
