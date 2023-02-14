<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\AppointmentController;

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

Route::namespace('Api')->group(function () {
    // Rutas Publicas
    Route::post('login', [AuthController::class, 'login']);
    // Route::post('signup', [AuthController::class, 'signUp']);
    Route::get('specialties', [SpecialtyController::class, 'index']);
    Route::get('specialties/{specialty}/doctors', [SpecialtyController::class, 'doctors']);
    Route::get('schedule/hours', [ScheduleController::class, 'hours']);

    // Rutas Privadas
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('person', [PatientController::class, 'show']);
        Route::post('person', [PatientController::class, 'update']);

        // Post Appointment
        Route::post('/appointments', [AppointmentController::class, 'store']);
        // Appointments
        Route::get('/appointments', [AppointmentController::class, 'index']);

        // FCM
        //Route::post('/fcm/token', 'FirebaseController@postToken');
    });
    
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
