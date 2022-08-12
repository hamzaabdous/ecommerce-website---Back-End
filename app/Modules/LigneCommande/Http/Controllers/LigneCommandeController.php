<?php

namespace App\Modules\LigneCommande\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\LigneCommande\Models\LigneCommande;
class LigneCommandeController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ligneCommande = LigneCommande::all();
        return [
            "payload" => $ligneCommande,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $ligneCommande=LigneCommande::find($id);
        if(!$ligneCommande){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $ligneCommande,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "qte" => "required:ligneCommandes,qte",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $ligneCommande=LigneCommande::make($request->all());
        $ligneCommande->save();
        return [
            "payload" => $ligneCommande,
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
        $ligneCommande=LigneCommande::find($request->id);
        if (!$ligneCommande) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $ligneCommande->qte=$request->qte;
        $ligneCommande->save();
        return [
            "payload" => $ligneCommande,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $ligneCommande=LigneCommande::find($request->id);
        if(!$ligneCommande){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $ligneCommande->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}
