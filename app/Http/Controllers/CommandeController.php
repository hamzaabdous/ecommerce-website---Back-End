<?php

namespace App\Http\Controllers;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    //
    public function index()
    {
        $books = Command::all();
        return response()->json($books);
    }
    public function store(Request $request)
    {
        $book = new Command;
        $book->status_commande = $request->status_commande;
        $book->quantity = $request->quantity;
        $book->publish_date = $request->publish_date;
        $book->save();
        return response()->json([
            "message" => "Book Added."
        ], 201);
    }
    public function show($id)
    {
        $book = Command::find($id);
        if (!empty($book)) {
            return response()->json($book);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (command::where('id', $id)->exists()) {
            $book = Command::find($id);
            $book->name = is_null($request->status_commande) ? $book->status_commande : $request->status_commande;
            $book->author = is_null($request->quantity) ? $book->quantity : $request->quantity;
            $book->publish_date = is_null($request->publish_date) ? $book->publish_date : $request->publish_date;
            $book->save();
            return response()->json([
                "message" => "Book Updated."
            ], 404);
        } else {
            return response()->json([
                "message" => "Book Not Found."
            ], 404);
        }
    }
    public function destroy($id)
    {
        if(Command::where('id', $id)->exists()) {
            $book = Command::find($id);
            $book->delete();

            return response()->json([
              "message" => "records deleted."
            ], 202);
        } else {
            return response()->json([
              "message" => "book not found."
            ], 404);
        }
    }
}
