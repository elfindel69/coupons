<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Coupon;
use DateTime;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function controleCoupon(){
        $user = Client::where('id',\request('id'))->first();
        $coupon = Coupon::where('nom',\request('coupon'))->first();

        foreach ($user->coupons as $coupon_user) {
            if ($coupon_user->id === $coupon->id) {

                if ($coupon->nom === 'VIVELESVACANCES') {
                    if ($coupon->date_de_debut <= date("Y-m-d") && $coupon->date_de_fin >= date("Y-m-d")) {
                        return response()->json(['data'=>true], 200);
                    } else {
                        return response()->json(['data'=>false], 200);
                    }
                }
                if ($coupon->nom === 'ONLYLYON') {

                    if ($coupon->date_de_debut <= date("Y-m-d") && $user->ville->nom === "Lyon") {
                        return response()->json(['data'=>true], 200);
                    } else {
                        return response()->json(['data'=>false], 200);
                    }

                }
                if ($coupon->nom === 'ETUDIANT23') {
                    if ($coupon->date_de_debut <= date("Y-m-d") && $coupon->date_de_fin >= date("Y-m-d")) {
                        $date1 = new DateTime($user->date_de_naissance);
                        $date2 = new DateTime(date("Y-m-d"));
                        $date_diff = $date1->diff($date2)->y;
                        if ($date_diff <= 23) {
                            return response()->json(['data'=>true], 200);
                        }else{
                            return response()->json(['data'=>false], 200);
                        }
                    }

                }
            }
        }
        return  response()->json(['data'=>false], 200);
    }
}
