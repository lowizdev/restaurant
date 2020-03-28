<?php

namespace App\Http\Controllers;

use App\JWT;
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
        //$this->middleware('auth');
        $this->middleware('jwt', ['only' => ['testjwt']]);
    }

    public function testlogin(Request $request){

        //var_dump($request);

        if(Auth::user()->name == "testman"){

            return "Ok";

        }

        return "Unavailable";
        

    }


    public function generatejwt(Request $request){

        $payload = [
            'name' => 'testman',
        ];

        return json_encode(['token' => JWT::encode($payload)]);
        
    }

    public function testjwt(Request $request){
        return "You are here!";
    }

    //
}
