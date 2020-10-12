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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');

//Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades', function () {
//    return view('adm.atividades');
//})->name('atividades');

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades',
[\App\Http\Controllers\Adm\Atividades::class,'index']
)->name('atividades.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades/create',
[\App\Http\Controllers\Adm\Atividades::class,'create']
)->name('atividades.create');

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades/show/{atividade}',
[\App\Http\Controllers\Adm\Atividades::class,'show']
)->name('atividades.show');
