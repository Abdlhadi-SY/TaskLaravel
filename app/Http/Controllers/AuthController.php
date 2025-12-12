<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterRequest $request){
        $data=$request->validated();
        $user=User::create([
            "name"=>$data->name,
            "email"=>$data->email,
            "password"=>Hash::make($data->password),
        ]);
        $token=$user->createToken("auth_token")->plainTextToken;
        return response()->json([
            "message"=>"registered successfully",
            "user"=>$user,
            "token"=>$token
        ]);
    }

    public function login(LoginRequest $request){
        if(!Auth::attempt($request->only("email","password"))){
            return response()->json(["message"=>"invalid email or password"],401
            );
        }
        $user=User::where("email",$request->email)->firstorfail();
        $token=$user->createToken("auth_token")->plainTextToken;
        return response()->json([
            "message"=>"Login success",
            "user"=>$user,
            "token"=>$token,
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message"=>"Logout success"]);
    }
}
