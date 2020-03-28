<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->middleware('auth');
    }

    public function testlogin(Request $request){

        //var_dump($request);

        if(Auth::user()->name == "testman"){

            return "Ok";

        }

        return "Unavailable";
        

    }

    //
}
