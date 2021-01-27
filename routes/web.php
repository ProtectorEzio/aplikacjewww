<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
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

Route::post('/app/dodajUzytkownika',[UserController::class, 'dodajUzytkownika']);
Route::post('/app/edytujUzytkownika',[UserController::class, 'edytujUzytkownika']);
Route::post('/app/usunUzytkownika',[UserController::class, 'usunUzytkownika']);
Route::get('/app/wyswietlUzytkownikow',[UserController::class, 'wyswietlUzytkownikow']);
Route::post('/login',[UserController::class, 'login']);

Route::post('/app/dodajPost',[PostController::class, 'dodajPost']);
Route::post('/app/edytujPost',[PostController::class, 'edytujPost']);
Route::post('/app/usunPost',[PostController::class, 'usunPost']);
Route::get('/app/wyswietlPosty',[PostController::class, 'wyswietlPosty']);
Route::get('/app/szukajPostu', [PostController::class, 'search']);
Route::get('/app/filtrujPost', [PostController::class, 'filtrujPostID']);
Route::get('/app/sortujPostydown', [PostController::class, 'sortujPostydown']);
Route::get('/app/sortujPostyup', [PostController::class, 'sortujPostyup']);

Route::post('/app/dodajRole', [RoleController::class, 'dodajRole']);
Route::post('/app/edytujRole', [RoleController::class, 'edytujRole']);
Route::get('/app/wyswietlRole', [RoleController::class, 'wyswietlRole']);

Route::get('/logout',[UserController::class, 'logout']);
Route::get('/',[UserController::class, 'index']);
Route::any('{xxx}',[UserController::class, 'index']);

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/{xxx}', function () {
    return view('welcome');
});
Route::get('/{xxx}/{xyz}', function () {
    return view('welcome');
});*/