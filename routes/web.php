<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\CommentsController;
use \App\Http\Controllers\LikeController;
use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\FriendsController;

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
})->name('indice');

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

    //Dashboard controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Like controller
    Route::post('/toggle_like/{id}', [LikeController::class, 'toggleLike']);

    //User controller
    Route::controller(UserController::class)->group(function () {
        Route::prefix('gente')->group(function () {
            Route::get('/', [UserController::class, 'gente'])->name('gente');
            Route::get('/{user_name}', [UserController::class, 'index'])->name('usuario');
        });
        Route::get('/mis_publicaciones', 'owner')->name('mis_publicaciones');
        Route::post('/busqueda', 'search')->name('buscar');
    });

    //Image controller
    Route::controller(ImageController::class)->group(function () {
       Route::get('/subir_imagen', 'upload')->name('subir_imagen');
       Route::get('/imagen/{id}', 'detail')->name('detalle_imagen');
       Route::post('/guardar_imagen', 'store')->name('guardar_imagen');
    });

    //Comments controller
    Route::controller(CommentsController::class)->group(function () {
        Route::post('/comentar/{id}', 'store')->name('comentar');
        Route::delete('/borrar_comentario/{id}', 'delete');
    });

    //Friends controller
    Route::controller(FriendsController::class)->group(function () {
        Route::get('/peticiones_amistad', 'show')->name('peticiones_amistad');
        Route::get('/amixes/{user}', 'index')->name('ver_amixes');
        Route::post('/amix/{user}', 'store');
        Route::patch('/aceptar/{user}', 'accept')->name('aceptar_amistad');
        Route::patch('/denegar/{user}', 'deny')->name('denegar_amistad');
        Route::delete('/amix/{user}', 'destroy');
    });
});

//fortify
require_once 'fortify.php';
