<?php

namespace App\Modules\Panier\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanierController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Panier::welcome");
    }
}
