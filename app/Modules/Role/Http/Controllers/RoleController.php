<?php

namespace App\Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Role\Models\Role;

class RoleController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return [
            "payload" => $roles,
            "status" => "200_00"
        ];
    }
    public function get($id)
    {
        $role=Role::find($id);
        if(!$role){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $role,
                "status" => "200_1"
            ];
        }
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string|unique:roles,name",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $role=Role::make($request->all());
        $role->save();
        return [
            "payload" => $role,
            "status" => "200"
        ];
    }
}
