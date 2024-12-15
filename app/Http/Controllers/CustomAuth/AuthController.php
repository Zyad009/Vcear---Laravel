<?php

namespace App\Http\Controllers\CustomAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    public function register(){
        return view("auth.register");
    }
    
    public function action(Request $request){
        
        $data =$request->validate([
            'name'=>['required','string','min:3','max:255'] ,
                'email'=>['required','email','string','max:255','unique:users'] ,
                'password'=>['required','string','min:8','confirmed']
            ]);
        $user =User::create($data);
        
        // FacadesAuth::login($user);
        
        auth()->login($user);

        return redirect()->route('home');
    }
    

    public function login(){
        return view("auth.login");
    }

    public function doLogin(Request $request)
    {

        $data = $request->validate([
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'string']
        ]);

            if(Auth::attempt($data)){
                $user = User::where("email" , $data['email'])->first();
                Auth::login($user);
                return redirect()->route('home');
            }else{
                return redirect()->back()->withErrors(["email_not_correct"=>"your email or password not valid !"]);
            }

            
        auth()->login($data);

    }

    public function logout(){
        auth()->logout();
        return redirect()->route('home');
    }
}
