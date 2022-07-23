<?php

namespace App\Modules\Panier\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Panier\Models\Panier;

class PanierController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $panier = Panier::all();
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
            return [
                "payload" => $panier,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "prixTotal" => "required:paniers,prixTotal",
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
}
