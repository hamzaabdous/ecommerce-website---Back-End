<?php

namespace App\Modules\Picture\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PictureController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Picture::welcome");
    }
}
