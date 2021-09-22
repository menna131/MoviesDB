<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $cred = $request->validate(['email' => 'required|exists:users,email',
        'password' => 'required|string']);
        if(!Auth::attempt($cred)){
            return response(['message' => 'Invalid login credentials']);
        }
        $user = User::find(1);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'accessToken' => $accessToken]);
    }
    public function all()
    {
        $users = User::get();
        return response($users);
    }
}


