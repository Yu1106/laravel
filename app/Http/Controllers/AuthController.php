<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(CreateUser $request)
    {
        $validateDate = $request->validated();
        $user = new User([
            'name' => $validateDate['name'],
            'email' => $validateDate['email'],
            'password' => bcrypt($validateDate['password']),
        ]);
        $user->save();
        return response('success', 201);
    }

    public function login(Request $request)
    {
        $validateDate = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if (!Auth::attempt($validateDate)) {
            return response('授權失敗', 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();
        return response(['token' => $tokenResult->accessToken]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(
            ['message' => '成功登出']
        );
    }

    public function user(Request $request)
    {
        return response(
            $request->user()
        );
    }
}
