<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('paciente/all','App\Http\Controllers\PacienteController@all');
Route::get('paciente/get/{id}','App\Http\Controllers\PacienteController@get');
Route::post('paciente/add','App\Http\Controllers\PacienteController@add');
Route::put('paciente/put/{id}','App\Http\Controllers\PacienteController@put');
Route::delete('paciente/remove/{id}','App\Http\Controllers\PacienteController@remove');


Route::get('receta/all/{paciente_id}','App\Http\Controllers\RecetaController@allByPaciente');
Route::get('receta/get/{id}','App\Http\Controllers\RecetaController@get');
Route::post('receta/add','App\Http\Controllers\RecetaController@add');
Route::put('receta/put/{id}','App\Http\Controllers\RecetaController@put');
Route::delete('receta/remove/{id}','App\Http\Controllers\RecetaController@remove');
