<?php

namespace App\Modules\Commande\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Commande\Models\Commande;
use Illuminate\Support\Facades\DB;
use App\Modules\LigneCommande\Models\LigneCommande;
use App\Modules\User\Models\User;
use App\Modules\Produit\Models\Produit;
use App\Modules\Panier\Models\Panier;

class CommandeController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commande = Commande::with('LigneCommande')->get();
        return [
            "payload" => $commande,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $commande=Commande::find($id);
        if(!$commande){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            $commande->ligne_commande=$commande->LigneCommande;

            return [
                "payload" => $commande,
                "status" => "200_1"
            ];
        }
    }

    public function makePanierEmptyByUser($id){
        $user=User::find($id);
        if(!$user){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
           // $user->panier=$user->panier;
            if ($user->panier!=null) {
               // $user->panier->produits=$user->panier->produits;

                for ($i=0; $i < count($user->panier->produits); $i++) {
                    $produit=Produit::find($user->panier->produits[$i]->id);
                    if(!$produit){
                        return [
                            "payload" => "The searched produit group row does not exist !",
                            "status" => "404_4"
                        ];
                    }
                    $panier=Panier::find($user->panier->id);
                    if(!$panier){
                        return [
                            "payload" => "The searched panier row does not exist !",
                            "status" => "404_4"
                        ];
                    }
                    $produit->paniers()->detach($panier);

                }

            }
            //$userUpdate=User::find($id);
            $user->panier=$user->panier;
            $user->panier->prixTotal=0;

            $user->panier->save();
            $user->panier->produits=[];

            return [
                "payload" => $user,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "status_commande" => "required|string:commandes,status_commande",
            "mantant" => "required:commandes,mantant",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $commande=Commande::make($request->all());
        $commande->save();
        $commandeID=DB::getPdo()->lastInsertId();
        $data=$request->all();

         for ($i=0; $i < count($data['placeorder']['panier']['produits']); $i++) {
            DB::table('ligne_commandes')->insert([
                'qte' => $data['placeorder']['panier']['produits'][$i]['pivot']['Qte'],
                'produit_id' => $data['placeorder']['panier']['produits'][$i]['id'],
                'user_id' => $data['placeorder']['panier']['user_id'],
                'commande_id' => $commandeID,
            ]);
        }
        $user=User::find($data['placeorder']['panier']['user_id']);
        if(!$user){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
           // $user->panier=$user->panier;
            if ($user->panier!=null) {
               // $user->panier->produits=$user->panier->produits;

                for ($i=0; $i < count($user->panier->produits); $i++) {
                    $produit=Produit::find($user->panier->produits[$i]->id);
                    if(!$produit){
                        return [
                            "payload" => "The searched produit group row does not exist !",
                            "status" => "404_4"
                        ];
                    }
                    $panier=Panier::find($user->panier->id);
                    if(!$panier){
                        return [
                            "payload" => "The searched panier row does not exist !",
                            "status" => "404_4"
                        ];
                    }
                    $produit->paniers()->detach($panier);

                }

            }
            //$userUpdate=User::find($id);
            $user->panier=$user->panier;
            $user->panier->prixTotal=0;

            $user->panier->save();
            $user->panier->produits=[];

            return [
                "payload" => $user,
                "status" => "200_1"
            ];
        }
        return [
            "data" => 'done',

            "status" => "200"
        ];
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            "status_commande" => "required|string:commandes,status_commande",
            "mantant" => "required:commandes,mantant",
               ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $commande=Commande::find($request->id);
        if (!$commande) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $commande->status_commande=$request->status_commande;
        $commande->mantant=$request->mantant;

        $commande->save();
        return [
            "payload" => $commande,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $commande=Commande::find($request->id);
        if(!$commande){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $commande->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}
