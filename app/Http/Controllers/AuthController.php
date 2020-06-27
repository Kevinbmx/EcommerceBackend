<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        try{
            $response = $http->post(config('services.passport.login_endpoint'),[
                'form_params'=>[
                    'grant_type'    =>  'password',
                    'client_id'     =>  config('services.passport.client_id'),
                    'client_secret' =>  config('services.passport.client_secret'),
                    'username'    =>  $request->username,
                    'password'    =>  $request->password,
                ]
            ]);
            return $response->getBody();
        }catch(\GuzzleHttp\Exception\BadResponseException $e){
            if($e->getCode() === 400){
                return response()->json('invalid Request. Please enter a username or password.',$e->getCode());
            }else if($e->getCode() === 401){
                return response()->json('your Credentials are incorrect. Please try again',$e->getCode());
            }
            return response()->json('Something went wrong on the server.',$e->getCode()) ;
        }
    }

    public function register(Request $request){
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' =>'required'
        ]);
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' =>  $request->role_id,
        ]);
    }
    public function logout(){
        auth()->user()->tokens->each(function ($token,$key){
            $token->delete();
        });
        return response()->json('Logged out succesfully',200);
    
    }
}
