<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/all-content', function () {
    $images = \App\Models\Image::all();
    foreach ($images as $image) {
        echo "<img src='$image->image_path'>" . "<br>";
        echo $image->description . "<br>";
        echo $image->user->name . " " . $image->user->surname;
        echo "<h3>Likes</h3><ul>";
        echo "<li>Total " . count($image->likes) . " Likes</li>";
        echo "</ul>";
        echo "<h3>Comentarios</h3><ul>";
        foreach ($image->comments as $comment) {
            echo "<li>" . $comment->user->name . " dijo: " . $comment->content . "</li><br>";
        }
        echo "</ul>";
        echo "<hr>";
    }
    die();
   return false;
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//fortify
require_once 'fortify.php';
