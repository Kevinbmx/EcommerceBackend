<?php

namespace App\Http\Controllers;

use DB;
use DateTime;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Pedido;
use App\Mail\ResetMail;
use App\Mail\ForgotMail;
use App\Mail\ConfirmedMail;
use Illuminate\Support\Str;
use App\Mail\RegisteredMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        // return $http;
        try{
            $response = $http->post(config('services.passport.login_endpoint'),[
                'form_params'=>[
                    'grant_type'    =>  'password',
                    'client_id'     =>  config('services.passport.client_id'),
                    'client_secret' =>  config('services.passport.client_secret'),
                    'username'      =>  $request->username,
                    'password'      =>  $request->password,
                ]
            ]);
            return $response->getBody();
        }catch(\GuzzleHttp\Exception\BadResponseException $e){
            // return $e;
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
        $userName = $request->name;
        $email = $request->email;
        Mail::to($email)->send(new RegisteredMail($userName));
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' =>  $request->role_id,
        ]);
    }

    public function pruebaEnvioEmail(Request $request){
        return env('EMAIL_NINO_TIENDA');
        // return 'entro';
        // try{
        //     $token = Str::uuid();
        //     Mail::to('kevi3195@gmail.com')->send(new ForgotMail($token));
        // }catch(\Exception $exception){
        //     return $exception;
        // }

        // $pedidoConfirmado = Pedido::with('direction')->with('carrito.product.file')
        // ->where('user_id',2)->whereNotIn('estado', ['carrito'])->where('id',2)->first();
        // // return $pedidoConfirmado;
        // echo $pedidoConfirmado;
        // // return $pedidoConfirmado->direction['direction'];
        // // Mail::to('kevi3195@gmail.com')->send(new ConfirmedMail($pedidoConfirmado));
        // $uuid = Str::uuid();
        // return $uuid;
        // $user = $request->user('api');
        // $email = 'ninotienda.com@gmail.com';
        // Mail::to($user->email)->bcc($email)->send(new ResetMail());
        // // return $emails;
        // Mail::send(new ResetMail(), [], function($message) use ($emails)
        // {
        //     $message->to($emails);
        // });
        // var_dump( Mail:: failures());
        // exit;

    }

    public function forgot(Request $request){
        $request->validate( [
            'email' => 'required|string|email|max:255',
            ]);
            // return $request->email;
        $email = $request->email;
        if (User::where('email', $email)->doesntExist()){
            return response([
                'message' => 'Su correo es incorrecto',
                'type' => 'error'
            ]);
        }
        try{
            // $token = Str::random(10);
            $token = Str::uuid();
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => new DateTime('now')
            ]);

            Mail::to($email)->send(new ForgotMail($token));

            return response([
                'message' => 'Te enviamos un email',
                'type' => 'success'
            ]);
        }catch(\Exception $exception){
            // return $exception;
            return response([
                'message' => 'ocurrio un error avisanos por favor',
                'type' => 'error',
                'error' => $exception->getMessage()
            ],400);
        }
    }

    public function reset(Request $request){
        // return "entro a reset";
        try {
            $request->validate( [
                'token' => 'required',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|string|min:6|same:password',
            ]);
            if(!$passwordResets = DB::table('password_resets')->where('token',$request->token)->first()){
                return response([
                    'message' => 'token invalido',
                    'type' => 'error',
                ]);
            }

            if(!$user = User::where('email',$passwordResets->email)->first()){
                return response([
                    'message' => 'usuario no existente',
                    'type' => 'error',
                ]);
            }

            $user->password = Hash::make($request->password);
            $user->save();
            Mail::to($passwordResets->email)->send(new ResetMail());

            return response([
                'message' => 'reseteo exitoso',
                'type' => 'success',
            ]);
        } catch (\Exception $exception) {
            // throw $exception;
            // return $exception->getMessage();
            // if($exception->getCode() === 404){
            //     return response()->json('your Credentials are incorrect. Please try again',$exception->getCode());
            // }
            return response([
                'message' => 'ocurrio un error intentelo mas tarde',
                'type' => 'error',
                'error' => $exception
            ],400);

        }
    }

    public function logout(){
        auth()->user()->tokens->each(function ($token,$key){
            $token->delete();
        });
        return response()->json('Logged out succesfully',200);

    }
}
