<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// トップページ（お問い合わせフォーム入力画面）
Route::get('/', [ContactsController::class, 'index'])->name('contacts.index');

// お問い合わせフォーム確認画面
Route::post('/confirm', [ContactsController::class, 'confirm'])->name('contacts.confirm');


Route::post('/store', [ContactsController::class, 'store'])->name('contact.store');

// お問い合わせフォーム送信処理（サンクスページ表示）
Route::post('/thanks', [ContactsController::class, 'store'])->name('contacts.store');

// サンクスページ
Route::get('/thanks', [ContactsController::class, 'thanks'])->name('contacts.thanks');

// ユーザー登録
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // 登録ページ表示
Route::post('/register', [RegisteredUserController::class, 'store']); // ユーザー登録処理

// ログイン
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // ログインページ表示
Route::post('/login', [LoginController::class, 'login']); // ログイン処理

// ホームページ（ログイン後のページ）
Route::get('/home', function () {
    return view('home');
})->name('home');

// 管理画面 - 検索機能
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search'); // 検索処理
Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete'); // 削除処理
