<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\CommentsController;
use \App\Http\Controllers\LikeController;
use \App\Http\Controllers\ProfileController;

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
    return view('index');
});

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified'
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/subir_imagen', [ImageController::class, 'upload'])->name('subir_imagen');
    Route::get('/imagen/{id}', [ImageController::class, 'detail'])->name('detalle_imagen');
    Route::get('/mis_publicaciones', [ProfileController::class, 'index'])->name('mis_publicaciones');
    Route::post('/guardar_imagen', [ImageController::class, 'store'])->name('guardar_imagen');
    Route::post('/comentar/{id}', [CommentsController::class, 'store'])->name('comentar');
    Route::post('/toggle_like/{id}', [LikeController::class, 'toggleLike']);
    Route::delete('/borrar_comentario/{id}', [CommentsController::class, 'delete']);
});

//fortify
require_once 'fortify.php';
