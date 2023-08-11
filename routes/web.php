<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DocumentTypesController;
use App\Http\Controllers\Admin\OfficerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StudentController;
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

/*Route::get('/student', function () {
    return view('student.index');
})->middleware('auth', 'role:Öğrenci')->name('student.index');*/

Route::middleware(['auth', 'role:Yönetici'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/officers', OfficerController::class);
    Route::resource('/businesses', BusinessController::class);
    Route::post('/students/password-reset/{id}', 'App\Http\Controllers\Admin\StudentController@passwordReset');
    Route::resource('/students', StudentController::class);
    Route::get('/student-search', [StudentController::class, 'searchBusiness']);
    Route::resource('/documents', DocumentController::class);
    Route::resource('/documenttypes', DocumentTypesController::class);
});

Route::middleware(['auth', 'role:Öğrenci'])->name('student.')->prefix('student')->group(function () {
    Route::get('/', [\App\Http\Controllers\Student\StudentController::class, 'index'])->name('index');
    Route::get('/application-form', [\App\Http\Controllers\Student\StudentController::class, 'applicationForm']);
    Route::get('/find-me-business', [\App\Http\Controllers\Student\StudentController::class, 'findMeBusiness']);
    Route::resource('/students', \App\Http\Controllers\Student\StudentController::class);
    Route::post('/apply/{id}', '\App\Http\Controllers\Student\StudentController@apply')->name('apply');
});


Route::get('/my-captcha', [HomeController::class, 'myCaptcha'])->name('myCaptcha');
Route::post('/my-captcha', [HomeController::class, 'myCaptchaPost'])->name('myCaptcha.post');
Route::get('/refresh_captcha', [HomeController::class, 'refreshCaptcha'])->name('refresh_captcha');

require __DIR__ . '/auth.php';
