<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    private $client_id;
    private $montant;
    private $livraison_id;

    protected $fillable = [
        'client_id',
        'montant',
        'livraison_id'
    ];

    public function client(){
       return $this->belongsTo(Client::class);
    }

    public function livraison(){
        return $this->hasOne(Livraison::class);
    }
    use HasFactory;
}
