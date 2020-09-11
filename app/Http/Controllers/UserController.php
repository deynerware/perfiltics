<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if ( ! empty( $params ) && ! empty( $params_array ) )
        {
            $params_array = array_map('trim', $params_array);

            $validate = \Validator::make($params_array, [
                'name'           => 'required|alpha',
                'surname'        => 'required|alpha',
                'email'          => 'required|unique:users',
                'password'       => 'required',
            ]);
    
            if ( $validate->fails() )
            {
                $data = array(
                    'status'        => 'error',
                    'code'          => 404,
                    'message'       => 'The user was not created correctly',
                    'errors'        => $validate->errors(),
                );
            }
            else
            {
                $pwd = hash('sha256', $params->password);

                $user = new User();

                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;

                $user->save();

                $data = array(
                    'status'        => 'success',
                    'code'          => 200,
                    'message'       => 'The user was created correctly',
                    'user'          => $user,
                );
            }
        }
        else
        {
            $data = array(
                'status'        => 'error',
                'code'          => 404,
                'message'       => 'The data sent is not correct',
            );
        }
    
        return response()->json($data, $data['code']);
    }

    public function login(Request $request) : string
    {
        $jwtAuth = new \JwtAuth();

        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        $validate = \Validator::make($params_array, [
            'email'          => 'required',
            'password'       => 'required',
        ]);

        if ( $validate->fails() ) {
            $signup = array(
                'status'        => 'error',
                'code'          => 404,
                'message'       => 'The user could not authenticate',
                'errors'        => $validate->errors(),
            );
        }
        else
        {
            $pwd = hash('sha256', $params->password);
            $signup = $jwtAuth->signup($params->email, $pwd);

            if ( ! empty( $params->gettoken ) )
                $signup = $jwtAuth->signup( $params->email, $pwd, true);
        }
        
        return response()->json( $signup, 200 );
    }

}
