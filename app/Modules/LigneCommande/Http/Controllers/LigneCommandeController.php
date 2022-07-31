<?php

namespace App\Modules\LigneCommande\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LigneCommandeController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("LigneCommande::welcome");
    }
}
