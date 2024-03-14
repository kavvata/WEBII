<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComprovanteController;
use App\Http\Controllers\DeclaracaoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/eixo', 'App\Http\Controllers\EixoController');
Route::resource('/nivel', 'App\Http\Controllers\NivelController');
Route::resource('/permission', PermissionController::class);
Route::resource('/turma', TurmaController::class);
Route::resource('/categoria', CategoriaController::class);
Route::resource('/user', UserController::class);
Route::resource('/aluno', AlunoController::class);
Route::resource('/comprovante', ComprovanteController::class);
Route::resource('/declaracao', DeclaracaoController::class);
