<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Models\Administrateur;
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
    Route::get('/', 'loginView')->name('login');
    Route::post('login', 'login');
    Route::get('logout', 'logout')->name('logout');
    Route::get('forgotPassword', 'forgotPassword')->name('forgot.password');
    Route::post('forgotPassword', 'sendEmail')->name('reset.password.email');
    Route::get('resetPassword/{token}', 'resetPassword');
    Route::post('resetPassword/{token}', 'newPassword');
});
Route::middleware(['Permission'])->group(function (){
    // -------------------------- main dashboard ----------------------//
    Route::controller(HomeController::class)->group(function () {
        Route::get('admin/dashboard', 'index')->name('admin.dashboard');
        Route::get('user/profile', 'userProfile')->name('user.profile');
        Route::get('teacher/dashboard', 'teacherDashboardIndex')->name('teacher.dashboard');
        Route::get('student/dashboard', 'studentDashboardIndex')->name('student.dashboard');
    });

    // ------------------------ student -------------------------------//
    Route::controller(EtudiantController::class)->group(function () {
        Route::get('etudiants/grid', 'studentGrid')->name('etudiants.grid');
        Route::get('/search-student', 'searchStudent'); 

    });
    Route::resource('etudiants', EtudiantController::class);

    // ------------------------ teacher -------------------------------//
    Route::resource('teachers', FormateurController::class);

    // ------------------------ Administration -------------------------------//
    Route::resource('administrateurs', AdministrateurController::class);
    Route::get('/get-filieres/{niveau}', [EtudiantController::class, 'getFilieres']);
    Route::get('/get-classes/{filiere}', [EtudiantController::class, 'getClasses']);

    // ------------------------ Classes -------------------------------//
    Route::resource('classe', ClasseController::class);
    Route::get('/search-class', [ClasseController::class, 'search']);

    // ------------------------ Cours -------------------------------//
    Route::resource('cours', CoursController::class);

    // ------------------------ Activite -------------------------------//
    Route::resource('activite', ActiviteController::class);


    // ------------------------ Notes -------------------------------//
    Route::resource('notes', NoteController::class);

    // ------------------------ Absences -------------------------------//
    Route::resource('absences', AbsenceController::class);
});
