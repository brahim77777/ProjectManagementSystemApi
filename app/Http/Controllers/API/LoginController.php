<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
        $this->middleware('auth.basic.once');
     }
    
    public function login(){
        $Token = Auth::user()->createToken('Access Token')->accessToken;
        return response()->json(['data'=>['email'=>Auth::user()->email] , 'token'=> $Token]);
    }


    public function register(Request $request){
        $request->validate(
            [
                'name' => 'nullable',
                'email' => 'required|email',
                'password' => 'required|min:4'
            ]
            );
        $data = request()->all();
        $data['password'] = bcrypt(request()->get('password'));

        User::create($data);
        
    }
}
