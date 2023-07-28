<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/deneme', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth', 'role:Yönetici')->name('admin.index');

Route::get('/officer', function () {
    return view('officer.index');
})->middleware('auth', 'role:Yetkili')->name('officer.index');

Route::get('/student', function () {
    return view('student.index');
})->middleware('auth', 'role:Öğrenci')->name('student.index');

Route::middleware(['auth', 'role:Yönetici'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
});

Route::get('/my-captcha', [HomeController::class, 'myCaptcha'])->name('myCaptcha');
Route::post('/my-captcha', [HomeController::class, 'myCaptchaPost'])->name('myCaptcha.post');
Route::get('/refresh_captcha', [HomeController::class, 'refreshCaptcha'])->name('refresh_captcha');

require __DIR__ . '/auth.php';
