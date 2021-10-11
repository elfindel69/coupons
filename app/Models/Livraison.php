<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    private $date_livraison;
    private $heure_livraison;
    private $adresse;
    private $commande_id;

    protected $fillable = [
        'date_livraison',
        'heure_livraison',
        'adresse',
        'commande_id'
    ];

    public function commande(){
        return $this->hasOne(Commande::class);
    }

    use HasFactory;
}
