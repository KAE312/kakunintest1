<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;






Route::get('/', function () {
    return redirect()->route('contact.index');
});
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

Route::post('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');

Route::get('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');



Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');

Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

Route::post('/login', function (LoginRequest $request) {
    // バリデーションされたデータ
    $data = $request->validated();

    // 認証ロジックなど書く（例）
    if (Auth::attempt($data)) {
        return redirect('/admin');
    }

    return back()->withErrors(['email' => 'ログイン情報が正しくありません。']);
});

Route::get('/login', function () {
    return view('auth.login'); // login.blade.php などのビューを返す
})->name('login');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});