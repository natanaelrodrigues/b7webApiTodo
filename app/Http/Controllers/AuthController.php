<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller
{
    public function create(Request $request){
        $array = ['error' => ''];

        $rules = [
            'email'=>'required|email|unique:users,email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        
        if ($validator->fails()){
            $array['error'] = $validator->messages();
            return $array;
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = new User();
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->token = '';
        $user->save();

        // falta logar no  usuário criado

        return $array;
    }
}

