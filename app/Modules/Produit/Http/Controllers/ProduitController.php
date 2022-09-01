<?php

namespace App\Modules\Produit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Produit\Models\Produit;
use App\Modules\Panier\Models\Panier;

class ProduitController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produit = Produit::with('categorie')->with('pictures')->with('LigneCommande')->get();
        return [
            "payload" => $produit,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $produit=Produit::find($id);
        if(!$produit){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            $produit->categorie=$produit->categorie;
            $produit->pictures=$produit->pictures;
            $produit->ligne_commande=$produit->LigneCommande;

            return [
                "payload" => $produit,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string|unique:categories,name",
            "prix" => "required:categories,prix",
            "stock" => "required|integer:categories,stock",
            "categorie_id" => "required|integer:categories,categorie_id",
        ]);

        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "hamza" =>$request->all(),
                "status" => "406_2"
            ];
        }
        $produit=Produit::make($request->all());
        $produit->save();
        return [
            "payload" => $produit,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $produit=Produit::find($request->id);
        if(!$produit){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $produit->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
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
        $produit=Produit::find($request->id);
        if (!$produit) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        if($request->name!=$produit->name){
            if(Produit::where("name",$request->name)->count()>0)
                return [
                    "payload" => "The produit has been already taken ! ",
                    "status" => "406_2"
                ];
        }
        $produit->name=$request->name;
        $produit->description=$request->description;
        $produit->stock=$request->stock;
        $produit->brand=$request->brand;
        $produit->src=$request->src;
        $produit->prix=$request->prix;
        $produit->categorie_id=$request->categorie_id;
        $produit->save();
        return [
            "payload" => $produit,
            "status" => "200"
        ];
    }

    public function addProduitToPanier(Request $request){
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "panier_id" =>"required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $produit=Produit::find($request->id);
        if (!$produit) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3-produit"
            ];
        }
        $panier=Panier::find($request->id);
        if (!$panier) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3-panier"
            ];
        }
        if($request->name!=$produit->name){
            if(Produit::where("name",$request->name)->count()>0)
                return [
                    "payload" => "The produit has been already taken ! ",
                    "status" => "406_2"
                ];
        }
        $produit->name=$request->name;
        $produit->description=$request->description;
        $produit->stock=$request->stock;
        $produit->brand=$request->brand;
        $produit->prix=$request->prix;
        $produit->categorie_id=$request->categorie_id;
        $produit->panier_id=$request->panier_id;
        $produit->save();
        return [
            "payload" => $produit,
            "status" => "200"
        ];
    }
}
