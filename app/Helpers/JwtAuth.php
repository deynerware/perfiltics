<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\User;

class JwtAuth {

    public $key;

    public function __construct()
    {   
        $this->key = 'this_is_our_key-9876543221';
    }

    public function signup( $email, $password, $getToken = null ) : string
    {
        $user = User::where([
            'email'     => $email,
            'password'  => $password
        ])->first();

        $signup = false;

        if ( is_object( $user ) ) $signup = true;

        if ( $signup )
        {
            $token = array(
                'sub'       => $user->id,
                'email'     => $user->email,
                'name'      => $user->name,
                'surname'   => $user->surname,
                'iat'       => time(),
                'exp'       => time() + (7 * 24 * 60 * 60)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decode = JWT::decode( $jwt, $this->key, ['HS256']);

            if ( is_null( $getToken ) ) 
                $data = $jwt;
            else 
                $data = $decode;
        }
        else
        {
            $data = array(
                'status'    => 'error',
                'message'   => 'Incorrent login'
            );
        }
            
        return $data;
    }

    public function checkToken( $jwt, $getIdentity = false )
    {
        $auth = false;

        try {
            $decoded = JWT::decode( $jwt, $this->key, ['HS256'] );
        } catch( \DomainException $e ) {
            $auth = false;
        }

        if ( ! empty( $decoded ) && is_object( $decoded ) && isset( $decoded->sub ) )
        {
            $auth = true;
            if ( $getIdentity && ! empty( $decoded ) )
                return $decoded;
        }
        else
        {
            $auth = false;
        }

        return $auth;  
    }

}