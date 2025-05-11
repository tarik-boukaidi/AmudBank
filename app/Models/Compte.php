<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_compte',
        'solde',
        'statut',
        'numero_compte',
        'numero_carte',
        'type_carte',
        'date_expiration',
        'code_securite',
        'plafond_journalier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function cartes(): HasMany
{
    return $this->hasMany(Carte::class);
}
}