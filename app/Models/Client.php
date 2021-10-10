<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    private $email;
    private $mot_de_passe;
    private $date_de_naissance;
    private $ville_id;

    protected $fillable = [
        'email',
        'mot_de_passe',
        'date_de_naissance',
        'ville_id'
    ];

    public function coupons(){
        return $this->belongsToMany(Coupon::class);
    }

    public function ville(){
        return $this->belongsTo(Ville::class);
    }
}
