<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class AuthController extends Controller
{

    public function postRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);

        $token = $user->createToken('Token')->accessToken;

        return response()->json(['token'=>$token, 'user' => $user], 200);
    }

    public function postLogin(Request $request)
    {
        session_start();
        $data = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        try {
            $request->session()->put('user',$data['email']);
        } catch (\Throwable $th) {
            echo "ERROR";
        }

        if(auth()->attempt($data)){

            $token = auth()->user()->createToken('Token')->accessToken;

            $session = session(['token' => $token]);
            Session::put('token', $token);
            // dd(Session::get('token'));

            return response()->json(['token'=>$token], 200);
            // return redirect('/api/get-user')->with('token', (response()->json(['token'=>$token], 200)));
        } else{
            return response()->json(['error'=>'unauthorized'],401);
        }
    }

    public function userInfo()
    {
        $user = auth()->user();
        return (new FormController)->index();
        // return response()->json(['user'=>$user], 200);
    }

    public function destroy()
    {
        $user = auth()->user()->token();
        $user->revoke();
        if ($user->revoke()) {
            return response()->json(['status'=>"Successfully Loggedout"], 200);
        }
    }
}
