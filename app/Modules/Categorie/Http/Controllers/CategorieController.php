<?php

namespace App\Modules\Categorie\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Categorie\Models\Categorie;

class CategorieController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie = Categorie::all();
        return [
            "payload" => $categorie,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $categorie=Categorie::find($id);
        if(!$categorie){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $categorie,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string|unique:categories,name",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $categorie=Categorie::make($request->all());
        $categorie->save();
        return [
            "payload" => $categorie,
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
        $categorie=Categorie::find($request->id);
        if (!$categorie) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        if($request->name!=$categorie->name){
            if(Categorie::where("name",$request->name)->count()>0)
                return [
                    "payload" => "The categorie has been already taken ! ",
                    "status" => "406_2"
                ];
        }
        $categorie->name=$request->name;
        $categorie->description=$request->description;

        $categorie->save();
        return [
            "payload" => $categorie,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $categorie=Categorie::find($request->id);
        if(!$categorie){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $categorie->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}
