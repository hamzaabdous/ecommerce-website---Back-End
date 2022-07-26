<?php

namespace App\Http\Controllers;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    //
    public function index()
    {
        $Commands = Command::all();
        return response()->json($Commands);
    }
    public function store(Request $request)
    {
        $cmd = new Command;
        $cmd->status_commande = $request->status_commande;
        $cmd->quantity = $request->quantity;
        $cmd->publish_date = $request->publish_date;
        $cmd->save();
        return response()->json([
            "message" => "commande Added."
        ], 201);
    }
    public function show($id)
    {
        $cmd = Command::find($id);
        if (!empty($cmd)) {
            return response()->json($cmd);
        } else {
            return response()->json([
                "message" => "commande not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (command::where('id', $id)->exists()) {
            $cmd = Command::find($id);
            $cmd->name = is_null($request->status_commande) ? $cmd->status_commande : $request->status_commande;
            $cmd->quantity = is_null($request->quantity) ? $cmd->quantity : $request->quantity;
            $cmd->publish_date = is_null($request->publish_date) ? $cmd->publish_date : $request->publish_date;
            $cmd->save();
            return response()->json([
                "message" => "commande Updated."
            ], 404);
        } else {
            return response()->json([
                "message" => "commande Not Found."
            ], 404);
        }
    }
    public function destroy($id)
    {
        if(Command::where('id', $id)->exists()) {
            $cmd = Command::find($id);
            $cmd->delete();

            return response()->json([
              "message" => "records deleted."
            ], 202);
        } else {
            return response()->json([
              "message" => "commande not found."
            ], 404);
        }
    }
}
