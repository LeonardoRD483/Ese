<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EstadoProcesoController;
use App\Http\Controllers\EstadosubprocesoController;
use App\Http\Controllers\EstructuraProcesoController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\SubProcesoController;
use App\Http\Controllers\UserController;
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
Route::post("/login", [UserController::class, 'authenticate']);
Route::group(['middleware' => ['jwtauth']], function () {
    //Empresa
    Route::resource("empresa", EmpresaController::class);
    //Proceso
    Route::resource("proceso", ProcesoController::class);
    //SubProceso
    Route::resource("subproceso", SubProcesoController::class);
    Route::resource("responsable",ResponsableController::class);
    Route::resource("estadoProceso",EstadoProcesoController::class);
    Route::resource("estadosubProceso",EstadosubprocesoController::class);
    Route::resource("estructura",EstructuraProcesoController::class);
    Route::resource("proyecto", ProyectoController::class);

    Route::post('/register', [UserController::class, 'register']);
    Route::post('/delete', [UserController::class, 'delete']);
    Route::post('/update', [UserController::class, 'update']);
});
Route::get("/listuser", [UserController::class, 'index']);
