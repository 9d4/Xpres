<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\LogPoolController;

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

Route::get('/', function () {
    return redirect(\route('login'));
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')
    ->prefix('main')
    ->group(function () {
        Route::view('/', 'main.index');

        Route::resource('classes', StudentClassController::class)
            ->names([
                'index' => 'classes',
            ]);
        Route::get('classes/{class}/students', [StudentController::class, 'studentsInClass'])->name('classes.students');
        Route::post('classes/{class}/students', [StudentController::class, 'storeStudentsInClass']);

        Route::get('/logpool', [LogPoolController::class, 'index'])->name('logpool.index');
        Route::post('/logpool', [LogPoolController::class, 'store']);
    });
