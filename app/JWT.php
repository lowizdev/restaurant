<?php

    //TODO: Register this as a service provider
    namespace App;


    class JWT{


        public static function encode($payload){

            $json_header = json_encode([
                "typ" => "JWT",
                "alg" => "HS256",
            ]);

            $json_payload = json_encode($payload);

            $b64header = JWT::signature_replace(base64_encode($json_header));
            $b64payload = JWT::signature_replace(base64_encode($json_payload));

            $key = "asimplekey";

            $signature = hash_hmac('sha256', $b64header.".".$b64payload, $key, true);

            $signature = JWT::signature_replace(base64_encode($signature));

            $token = implode(".", [$b64header, $b64payload, $signature]);

            return $token;

        }

        public static function signature_replace($b64encoded){
            return str_replace(['+', '/', '='], ['-', '_', ''], $b64encoded);
        }

        public static function decode($token){

            $token = explode(".", $token);

            //return([base64_decode($token[0]), base64_decode($token[1]), base64_decode($token[2])]);
            return $token;

        }

        public static function validate($token){

            //TODO: Make key global

            $key = "asimplekey";

            

            $signature = hash_hmac('sha256', $token[0].".".$token[1], $key, true);
            $signature = JWT::signature_replace(base64_encode($signature));
            
            

            if($signature == $token[2]){
                return $token;
            }

            return null;


        }
    
    
    }



?>