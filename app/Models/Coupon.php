<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    private $nom;
    private $date_de_debut;
    private $date_de_fin;
    protected $fillable = [
       'nom',
        'date_de_debut',
        'date_de_fin'

    ];
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
