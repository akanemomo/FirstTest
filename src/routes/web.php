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
*/

// お問い合わせフォーム関連
Route::get('/', [ContactsController::class, 'index'])->name('contacts.index');
Route::post('/confirm', [ContactsController::class, 'confirm'])->name('contacts.confirm');
Route::post('/store', [ContactsController::class, 'store'])->name('contacts.store');
Route::get('/thanks', [ContactsController::class, 'thanks'])->name('contacts.thanks');

// 登録ページ
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// ログインページ
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// 管理画面関連
Route::prefix('admin')->name('admin.')->group(function () {
    // 管理画面トップ
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // 検索処理
    Route::get('/search', [AdminController::class, 'search'])->name('search');

    // 詳細情報取得
    Route::get('/contact/{id}', [AdminController::class, 'show'])->name('contact.show');

    // 削除処理
    Route::delete('/contact/{id}', [AdminController::class, 'delete'])->name('contact.delete');
});
