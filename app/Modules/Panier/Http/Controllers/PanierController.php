<?php

namespace App\Modules\Panier\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Panier\Models\Panier;
use App\Modules\Produit\Models\Produit;
use App\Modules\User\Models\User;

class PanierController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $panier = Panier::with('produits')->get();
        return [
            "payload" => $panier,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $panier=Panier::find($id);
        if(!$panier){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            $panier->produits=$panier->produits;

            return [
                "payload" => $panier,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $panier=Panier::make($request->all());
        $panier->save();
        return [
            "payload" => $panier,
            "status" => "200"
        ];
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $panier=Panier::find($request->id);
        if (!$panier) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        $panier->prixTotal=$request->prixTotal;

        $panier->save();
        return [
            "payload" => $panier,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $panier=Panier::find($request->id);
        if(!$panier){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $panier->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }

    public function getProduitsByPanier($id){
        $panier=Panier::find($id);
        if(!$panier){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            $user=User::find($panier->user_id);

            return [
                "payload" => $panier->produits()->with("categorie")->with("pictures")->get(),
                "user" =>$user,
                "status" => "200_1"
            ];
        }
    }

    public function addProduitToPanier(Request $request){
        $validator = Validator::make($request->all(), [
            "panier_id" => "required",
            "produit_id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $panier=Panier::find($request->panier_id);
        if(!$panier){
            return [
                "payload"=>"panier is not exist !",
                "status"=>"panier_404",
            ];
        }
        $produit=Produit::find($request->produit_id);
        if(!$produit){
            return [
                "payload"=>"produit Group is not exist !",
                "status"=>"produit_404",
            ];
        }

        $produit->paniers()->attach($panier);
        $panier->produits=$panier->produits;
        return [
            "payload" => $panier,
            "status" => "200"
        ];
    }

    public function deleteProduitFromPanier(Request $request){
        $produit=Produit::find($request->produit_id);
        if(!$produit){
            return [
                "payload" => "The searched produit group row does not exist !",
                "status" => "404_4"
            ];
        }
        $panier=Panier::find($request->panier_id);
        if(!$panier){
            return [
                "payload" => "The searched panier row does not exist !",
                "status" => "404_4"
            ];
        }

            $produit->paniers()->detach($panier);
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];

    }
}
