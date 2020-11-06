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

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/config', function () {
    return view('config');
})->name('config');


//Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades', function () {
//    return view('adm.atividades');
//})->name('atividades');

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades',
[\App\Http\Controllers\Adm\Atividades::class,'index']
)->name('atividades.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades/create',
[\App\Http\Controllers\Adm\Atividades::class,'create']
)->name('atividades.create');

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades/generate-qr-code/{id}',
[\App\Http\Controllers\Adm\Atividades::class,'generateQrCode']
)->name('atividades.generate-qr-code');

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades/pdf-general-code/{id}',
[\App\Http\Controllers\Adm\Atividades::class,'generatePdfQrCode']
)->name('atividades.generate-pdf-qrcode');

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/atividades/show/{atividade}',
[\App\Http\Controllers\Adm\Atividades::class,'show']
)->name('resources.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/resources',
[\App\Http\Controllers\Adm\Resources::class,'index']
);

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/resources/create',
    [\App\Http\Controllers\Adm\Resources::class,'create']
)->name('resources.create');

Route::middleware(['auth:sanctum', 'verified'])->get('/adm/schedules',
    [\App\Http\Controllers\Adm\Schedules::class,'index']
)->name('schedules.index');


Route::get('/guest/list-tasks-id/{id}',
    [\App\Http\Controllers\Guest\Index::class,'listTasksId']
);
