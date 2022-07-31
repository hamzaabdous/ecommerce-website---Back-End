<?php

namespace App\Modules\Picture\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Libs\UploadTrait;
use App\Modules\User\Models\User;
use App\Modules\Picture\Models\Picture;
use App\Modules\Produit\Models\Produit;

class PictureController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    use UploadTrait;

    public function photoprofile(Request $request){
        $validator = Validator::make($request->all(), [
            "user_id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }

        $user=User::find($request->user_id);
        if(!$user){
            return [
                "payload"=>"user is not exist !",
                "status"=>"user_404",
            ];
        }
        $picture=new Picture();

        if($request->file()) {
            for ($i=0;$i<count($request->photos);$i++){
                $file=$request->photos[$i];
                $filename=time()."_".$file->getClientOriginalName();
                $this->uploadOne($file, config('cdn.usersPhotos.path'),$filename);
                $picture->filename=$filename;
                $picture->user_id=$user->id;
                $picture->save();
            }
        }
        $user->save();
        $user->picture=$picture;
        return [
            "payload"=>$user,
            "status"=>"200_04",
        ];
    }
    public function photosProduits(Request $request){
        $validator = Validator::make($request->all(), [
            "Produit_id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }

        $produit=Produit::find($request->Produit_id);
        if(!$produit){
            return [
                "payload"=>"produit is not exist !",
                "status"=>"produit_404",
            ];
        }

        if($request->file()) {
            for ($i=0;$i<count($request->photos);$i++){
                $file=$request->photos[$i];
                $filename=time()."_".$file->getClientOriginalName();
                $this->uploadOne($file, config('cdn.usersPhotos.path'),$filename);
                $picture=new Picture();

                $picture->filename=$filename;
                $picture->Produit_id=$produit->id;
                $picture->save();
            }
        }
        $produit->categorie=$produit->categorie;
        $produit->pictures=$produit->pictures;
        return [
            "payload"=>$produit,
            "status"=>"200_04",
        ];
    }


    public function PhotosStoragePath(){
        return [
            "payload" => asset("/storage/cdn/usersPhotos/"),
            "status" => "200_1"
        ];
    }

}

