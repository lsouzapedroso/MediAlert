<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'laravel-version' => app()->version(),
    ];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);

Route::middleware([Middleware::class])->group(function () {
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('/medicos', [MedicController::class, 'store']);
    Route::post('/medicos/consulta', [AppointmentsController::class, 'store']);
    Route::get('/medicos/{id_medico}/pacientes', [MedicController::class, 'listMedicPatient']);

    Route::get('/pacientes', [PatientController::class, 'store']);
    Route::post('/pacientes', [PatientController::class, 'store']);
    Route::put('/pacientes/{id_paciente}', [PatientController::class, 'update']);

    Route::post('/clinicas', [ClinicController::class, 'register']);
    Route::put('/clinic/{clinic_id}', [ClinicController::class, 'updateClinic']);

    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']); // Ou Route::patch para atualizações parciais
    Route::delete('/user/{id}', [UserController::class, 'destroy']);


});

