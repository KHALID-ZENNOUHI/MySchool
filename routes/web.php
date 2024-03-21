<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\HomeController;
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

// ----------------------------Authentification ------------------------------//
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'loginView')->name('login');
    Route::post('login', 'login');
    Route::get('logout', 'logout')->name('logout');
    Route::get('forgotPassword', 'forgotPassword')->name('forgot.password');
    Route::post('forgotPassword', 'sendEmail')->name('reset.password.email');
    Route::get('resetPassword/{token}', 'resetPassword');
    Route::post('resetPassword/{token}', 'newPassword');
});

// -------------------------- main dashboard ----------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('user/profile', 'userProfile')->name('user.profile');
    Route::get('teacher/dashboard', 'teacherDashboardIndex')->name('teacher.dashboard');
    Route::get('student/dashboard', 'studentDashboardIndex')->name('student.dashboard');
});

// ------------------------ student -------------------------------//
Route::controller(EtudiantController::class)->group(function () {
    Route::get('students', 'index')->name('students.index'); 
    Route::get('students/grid', 'studentGrid')->name('students.grid'); 
    Route::get('students/create', 'create')->name('students.create'); 
    Route::post('students', 'store')->name('student.store');
    Route::get('students/{etudiant}/edit', 'edit')->name('students.edit'); 
    Route::put('students/{etudiant}', 'update')->name('students.update'); 
    Route::delete('students/{etudiant}', 'destroy')->name('students.destroy'); 
    Route::get('student/profile/{id}', 'studentProfile')->name('student.profile');
});
