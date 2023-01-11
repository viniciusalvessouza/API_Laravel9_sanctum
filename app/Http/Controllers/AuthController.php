<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Registrar um novo Usuario
     */
    public function register(Request $request){
        //o parametro confirmed eh para ter dupla senha
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
    
        $token = $user->createToken('primeiroToken');

        $response =[
            'user'=>$user,
            'token'=>$token
        ];

        return response($response,201);
    }

    /**
     * Login do Usuario
     */
    public function login(Request $request){
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
    
        //checar o e-mail
        $user = User::where('email',$request->email)->first();
        
        //valida usuario e checa o password
            //fiz uma pequena alteracao caso eu digite um usuario invalido        
        if(isset($user->password))
            $passwordValidaton = Hash::check($request->password,$user->password);
        else $passwordValidaton = null;
        
        if(!$user || !$passwordValidaton){
            return response(['message'=>'invalid credentials'],401);
        }
        
        $token = $user->createToken('primeiroToken');

        $response =[
            'user'=>$user,
            'token'=>$token
        ];
        
        return response ($response,201);

    }
    /**
     * Logout do Usuario
     */

    public function logout(){

        auth()->user()->tokens()->delete();
        
        return [
            'message'=> 'logout and token destruction successfully'
        ];
    
    }

}
