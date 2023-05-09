<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaracteristicaController;
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


Route::get('/',[CaracteristicaController::class,'index']);

Route::group(['prefix' => 'equipos'], function () {
    Route::get('/all',[CaracteristicaController::class,'getEquipos']);
    Route::post('/save',[CaracteristicaController::class,'save']);
    Route::get('/getEquipoById',[CaracteristicaController::class,'getEquipoById']);
    Route::post('/changeStatus',[CaracteristicaController::class,'changeState']);
    Route::post('/delete',[CaracteristicaController::class,'deleteEquipo']);
});

