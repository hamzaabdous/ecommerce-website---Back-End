<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\Produit\Models\Produit;
use App\Modules\Role\Models\Role;
use App\Modules\User\Models\User;
use App\Modules\Picture\Models\Picture;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $users=User::with('role')->with('picture')->with('panier')->get();
       // $users=User::all();

        return [
            "payload" => $users,
            "status" => "200_00"
        ];
    }
    public function get($id){
        $user=User::find($id);

        if(!$user){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            $user->role=$user->role;
            $user->picture=$user->picture;
            $user->panier=$user->panier;
            if ($user->panier!=null) {
                $user->panier->produits=$user->panier->produits;
            }

           // $user->produit=$user->produit;
            return [
                "payload" => $user,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "username" => "required|string|unique:users,username",
            "role_id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $role=Role::find($request->role_id);
        if(!$role){
            return [
                "payload"=>"role is not exist !",
                "status"=>"role_404",
            ];
        }
        $user=User::make($request->all());
        $user->password="123";
        $user->save();

        return [
            "payload" => $user,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $user=User::find($request->id);
        if(!$user){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $user->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "role_id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $user=User::find($request->id);
        if (!$user) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        if($request->username!=$user->username){
            if(User::where("username",$request->username)->count()>0)
                return [
                    "payload" => "The user has been already taken ! ",
                    "status" => "406_2"
                ];
        }

        $role=Role::find($request->role_id);
        if(!$role){
            return [
                "payload"=>"role is not exist !",
                "status"=>"role_404",
            ];
        }

        $user->username=$request->username;
        $user->lastName=$request->lastName;
        $user->firstName=$request->firstName;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->phoneNumber=$request->phoneNumber;
        $user->role_id=$request->role_id;

        $user->save();
        $user->role=$user->role;


        return [
            "payload" => $user,
            "status" => "200"
        ];
    }

    public function getProduitsByUser($id){
        $user=User::find($id);
        if(!$user){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $user->produits()->with("categorie")->get(),
                "status" => "200_1"
            ];
        }
    }
    public function getUsersByProduit($id){
        $produit=Produit::find($id);
        if(!$produit){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $produit->user()->with('role')->with('picture')->get(),
                "status" => "200_1"
            ];
        }
    }

    public function addUserToProduit(Request $request){
        $validator = Validator::make($request->all(), [
            "user_id" => "required",
            "produit_id" => "required",
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
                "payload"=>"User is not exist !",
                "status"=>"user_404",
            ];
        }
        $produit=Produit::find($request->produit_id);
        if(!$produit){
            return [
                "payload"=>"produit Group is not exist !",
                "status"=>"produit_404",
            ];
        }

        $produit->user()->attach($user);
        $user->produits=$user->produits;
        return [
            "payload" => $user,
            "status" => "200"
        ];
    }

    public function deleteUserToProduit(Request $request){
        $produit=Produit::find($request->produit_id);
        if(!$produit){
            return [
                "payload" => "The searched produit group row does not exist !",
                "status" => "404_4"
            ];
        }
        $user=User::find($request->user_id);
        if(!$user){
            return [
                "payload" => "The searched user row does not exist !",
                "status" => "404_4"
            ];
        }

            $produit->user()->detach($user);
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];

    }

    public function changePassword(Request $request){

        $validator = Validator::make($request->all(), [
            "id" => "required",
            "password" => "required|string|confirmed",

        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }
        $user=User::find($request->id);
        if (!$user) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404"
            ];
        }


        $user->password=$request->password;

        $user->save();
        return [
            "payload" => $user,
            "status" => "200"
        ];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required|string",
            "password" => "required|string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }
        $user = User::where('username', $request->username)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return [
                "payload" => "Incorrect username or password !",
                "status" => "401"
            ];
        }
        $user->role=$user->role;
            $user->picture=$user->picture;
            $user->panier=$user->panier;
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return [
            "payload" => $response,
            "status" => "200"
        ];
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            "payload" => "User Logged out successfully !",
            "status" => "200"
        ];
    }
}
