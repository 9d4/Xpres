<?php

use App\Models\StudentClass;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\LogPoolController;
use App\Http\Controllers\LogController;

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

        Route::get('classes', [StudentClassController::class, 'index'])->name('classes');
        Route::post('classes', [StudentClassController::class, 'store']);
        Route::put('classes/{class}', [StudentClassController::class, 'update'])->name('classes.update');

        Route::get('classes/{class}/students', [StudentController::class, 'studentsInClass'])->name('classes.students');
        Route::post('classes/{class}/students', [StudentController::class, 'storeStudentsInClassXlsx']);

        Route::get('/logpool', [LogPoolController::class, 'index'])->name('logpool.index');
        Route::post('/logpool', [LogPoolController::class, 'store']);

        Route::get('/logs', [LogController::class, 'show'])->name('logs');
        Route::post('/logs', [LogController::class, 'export'])->name('logs.export');
        Route::get('/logs/{logPool}', [LogController::class, 'show'])->name('logs.show');
        Route::get('/logs/{logPool}/{class}', [LogController::class, 'showStudents'])->name('logs.show.students');
        Route::post('/logs/{logPool}/{class}', [LogController::class, 'store']);
    });

Route::middleware('auth')
    ->group(function () {
        Route::get('download/exampleimport', function () {
            return \Illuminate\Support\Facades\Storage::disk('public')->download('exampleimport.xls');
        })->name('download.exampleimport');
    });

Route::get('/tmp/{asd}', function () {

});
