<?php

namespace App\Modules\Facture\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Facture\Models\Facture;
use Illuminate\Support\Facades\Validator;

class FactureController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $facture = Facture::all();
        return [
            "payload" => $facture,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $facture=Facture::find($id);
        if(!$facture){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $facture,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "mantant" => "required:factures,mantant",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $facture=Facture::make($request->all());
        $facture->save();
        return [
            "payload" => $facture,
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
        $facture=Facture::find($request->id);
        if (!$facture) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $facture->mantant=$request->mantant;
        $facture->save();
        return [
            "payload" => $facture,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $facture=Facture::find($request->id);
        if(!$facture){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $facture->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}
