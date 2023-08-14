<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    public function login(Request $request){
        $admin = $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt($admin)){
            $user=Auth::user();
            return response()->json([
                'errors'=>['message' => 'You have entered an invalid username or password']
            ],422);
        }
         
        $admin=Auth::user();

        return response()->json([
            'user' => $admin,
            'token' => $admin->createToken('$smart_med_web$')->plainTextToken,
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        Auth::guard('web')->logout();
        
        return response()->json([
            'message' => 'logged out'
        ]);
    }

    public function user(){
        return response()->json([
            'user' => Auth::user()
        ]);
    }
}
