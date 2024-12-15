<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\V1\Traits\Api;

class AuthController extends Controller
{
    use Api ;

    public function register(RegisterRequest $request){
        // $data = $request->validate([
        //     'name' => ['required', 'string', 'min:3', 'max:255'],
        //     'email' => ['required', 'email', 'string', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed']
        // ]);
        
        $data =$request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $token = $user->createToken('new token')->plainTextToken;  
        

             return response()->json([
                'user' => $user ,
                'token' => $token
        ]);
    }

    public function login( Request $request){
        $data = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ]);

        if(Auth::attempt($data)){
            $user = User::where("email", $data['email'])->first();
            $token = $user->createToken("new token")->plainTextToken;


            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
            
        }else{
            return response()->json(["error"=> "your email or password not valid !"] , 422);
        }
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(["message"=>"logged out"]);
    }
}
