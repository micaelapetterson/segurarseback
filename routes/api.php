<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GestorEmpleadoController;
use App\Http\Controllers\PuestoController;

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

Route::get("/saludo", function(){
    return "Devolver mensaje de Bienvenida";
});


Route::prefix('/v1/auth')->group(function (){

    Route::post('/login', [AuthController::class, "funLogin"]);
    Route::post('/register', [AuthController::class, "funRegistro"]);

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/perfil', [AuthController::class, "funPerfil"]);
        Route::post('/logout', [AuthController::class, "funSalir"]);
    });   

});

Route::middleware('auth:sanctum')->group(function(){

    Route::apiResource("empleado", EmpleadoController::class);

    Route::post('agregarEmpleado', [GestorEmpleadoController::class, "agregarEmpleado"]);
    Route::get('salarioPromedio', [GestorEmpleadoController::class, "salarioPromedio"]);
    Route::post('incrementarSalarios', [GestorEmpleadoController::class, "incrementarSalarios"]);
    Route::get('visualizarSalarios', [GestorEmpleadoController::class, "visualizarSalarios"]);
    Route::post('incrementarSalariosAll', [GestorEmpleadoController::class, "incrementarSalariosAll"]);

    Route::get('getPuestos', [PuestoController::class, "index"]);

});

Route::get('getEmpleados', [EmpleadoController::class, "getAll"]);


Route::get("no-autorizado", function(){
    return ["message" => "No tienes permiso"];
})->name("login");
