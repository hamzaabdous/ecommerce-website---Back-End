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
    
}
