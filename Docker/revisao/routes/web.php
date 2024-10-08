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

Route::resource('eixo', 'App\Http\Controllers\EixoController');
Route::get('report/eixo', 'App\Http\Controllers\EixoController@report')->name('report');
Route::get('graph/eixo', 'App\Http\Controllers\EixoController@graph')->name('graph');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
