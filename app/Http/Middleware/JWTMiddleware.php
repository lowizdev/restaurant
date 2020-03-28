<?php

namespace App\Http\Middleware;

use App\JWT;
use Closure;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //dd($request);
        //dd($request->bearerToken());

        //TEST WITH SIMPLE VALIDATION
        //$token = $request->input('token');
        $token = $request->bearerToken();

        if(isset($token)){
            $token = JWT::decode($token);

            //var_dump($token[2]);

            if(JWT::validate($token)){
                return $next($request);
            }else{
                return response()->json([
                    'error' => 'Invalid error'
                ], 401);
            }
        }

        return response()->json([
            'error' => 'Token error'
        ], 401);
        

        
    }
}
