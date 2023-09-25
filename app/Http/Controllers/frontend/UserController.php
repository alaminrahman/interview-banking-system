<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function openAccount(){
        return view('frontend.pages.auth.openAccount');
    }

    public function store(Request $request){

        $validated = $this->validate($request,[
            'name' => 'required',
            'account_type' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $validated['balance'] = 0;
        $validated['password'] = bcrypt($request->password);

        User::create($validated);

        return redirect('/')->with('success', 'Create successfully');
    }

    public function login(){
        return view('frontend.pages.auth.login');
    }

    public function loginAction(Request $request){

        $validated = $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if(!$user){
            return redirect()->back()->with('error', 'Invalid account!');
        }

        if(Auth::guard('web')->attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->remember)){
            return redirect()->intended('/user/dashboard')->with('success', 'Login successfully');
        }else{
            return redirect()->back()->with('error', 'Invalid password!');
        }

    }   

    public function logout(Request $request){
        
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout successfully!');
    }
    //End
}
