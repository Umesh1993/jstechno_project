<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $input = $request->all();
        $email = $input['email'];
        $password = md5($input['password']);

        
        $users = User::where("email",$email)->where("password",$password)->first();
        if($users){
            session(['id' => $users->id,'name' => $users->name, 'email' => $users->email]);
            return redirect('dashboard');
        } else {
            return redirect('/')->withErrors(['msg' => 'Credential wrong, please try again..']);
        }
    } 


    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/');
    }
}
