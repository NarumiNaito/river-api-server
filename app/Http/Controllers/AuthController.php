<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function user(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    public function register(RegisterRequest $request)
    {
        
        $existsEmail = User::where('email', $request->email)->exists();

        if ($existsEmail) {
            return response()->json([
                'message' => 'メールアドレスがすでに登録されています。'
            ]
        );
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('user')->login($user);

        return response()->json([
            'message' => 'ユーザ登録が完了しました。',
            'user' => $user,
        ])->cookie('auth_user_session', "auth_user_session", 120);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::guard('user')->attempt($credentials)) {
            throw new AuthenticationException('ログインに失敗しました。入力内容を確認して下さい。');
        }

        $request->session()->regenerate();
        $user = Auth::guard('user')->user();


        return response()->json([
            'message' => 'ログインしました。',
            'user' => $user,
        ])->cookie('auth_user_session', 'auth_user_session', 120);
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Cookie::queue(Cookie::forget('auth_user_session'));

        return response()->json([
            'message' => 'ログアウトしました。',
        ]);
    }

}
