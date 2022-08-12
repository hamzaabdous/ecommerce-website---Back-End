<?php

namespace App\Modules\Commande\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Commande\Models\Commande;

class CommandeController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commande = Commande::all();
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
            return [
                "payload" => $commande,
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
        return [
            "payload" => $commande,
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
