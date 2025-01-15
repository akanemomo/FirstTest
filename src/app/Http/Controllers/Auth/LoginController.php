<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // ログインフォーム表示
    public function showLoginForm()
    {
        return view('auth.login');  // ログインフォームのビューを返す
    }

    public function login(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email', // メールは必須
            'password' => 'required|string|min:8', // パスワードは必須
        ]);

        // ログイン処理
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            // ログイン成功時、管理画面のインデックスにリダイレクト
            return redirect()->route('admin.index');  // admin.dashboard → admin.index
        } else {
            // ログイン失敗時
            return back()->withErrors(['email' => 'ログインに失敗しました。']);
        }
    }
}
