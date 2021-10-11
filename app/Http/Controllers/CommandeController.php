<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Livraison;
use DateTime;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
   public function creationCommande(){
      $id = request("id");

      $commande = Commande::find($id);
      if(!is_null($commande)){
          $date_livraison=request("date_livraison");
          $heure_livraison=request("heure_livraison");

          $livraison=Livraison::where(["date_livraison"=>$date_livraison,"heure_livraison"=>$heure_livraison])->first();

          if(is_null($livraison)||is_null($commande->livraison)||$commande->__get("livraison_id") ===0){
              $date1 = null;
              $date2  = null;
              try {
                  $date1 = new DateTime($commande->created_at);
              } catch (\Exception $e) {
              }
              try {
                  $date2 = new DateTime($date_livraison);
              } catch (\Exception $e) {
              }
              $diff= $date2->diff($date1)->d;
              echo $diff;
              if($diff === 2){
                  $livraison = new Livraison();

                  $livraison->__set("commande_id",$id);
                  $livraison->__set("date_livraison",$date_livraison);
                  $livraison->__set("heure_livraison",$heure_livraison);
                  $livraison->save();
                  $livraison->commande = $commande;
                  $commande->__set("livraison_id",$livraison->id);

                  $commande->save();
                  $commande->livraison = $livraison;
                  return response()->json(['data'=>'livraison enregistrée'],201);
              }else{
                  return response()->json(['data'=>'erreur, date de livraison erronnée'],200);
              }


          }else{
              return response()->json(['data'=>'erreur, créneau déjà réservé'],200);
          }
      }else{
          return response()->json(['data'=>'erreur, commande inexistante'],200);
      }

   }
}
