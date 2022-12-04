<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MedicalAppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ClinicHistoryController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MedicalConsultationController;

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
    // return view('welcome');
    return redirect('/login');
});

Auth::routes(['login' => false,'logout' => false]);

Route::get('/login', [LoginController::class, 'getLogin'])->name('loginUser');
Route::post('/login', [LoginController::class, 'postLogin'])->name('loginUserPost');
Route::get('/logout', [LoginController::class, 'getLogout'])->name('logoutUser');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Especialidades
Route::get('/specialties', [SpecialtyController::class, 'index']);
Route::get('/specialties/create', [SpecialtyController::class, 'create']); // Formulario de Especialidades
Route::get('/specialties/{specialty}/edit', [SpecialtyController::class, 'edit']); // Formulario de Edicion de Especialidades
Route::post('/specialties', [SpecialtyController::class, 'store']); // Envio del Formulario de Especialidades
Route::put('/specialties/{specialty}', [SpecialtyController::class, 'update']); // Editar una Especialidad
Route::delete('/specialties/{specialty}', [SpecialtyController::class, 'destroy']); // Eliminar una Especialidad

// Roles
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/create', [RoleController::class, 'create']); // Formulario de Roles
Route::get('/roles/{role}/edit', [RoleController::class, 'edit']); // Formulario de Edicion de Roles
Route::post('/roles', [RoleController::class, 'store']); // Envio del Formulario de Roles
Route::put('/roles/{role}', [RoleController::class, 'update']); // Editar una Rol
Route::delete('/roles/{role}', [RoleController::class, 'destroy']); // Eliminar una Rol

// Appointment Medicals
Route::get('/medical_appointments/create', [MedicalAppointmentController::class, 'create']);

// Doctors
Route::get('/doctors', [DoctorController::class, 'index']);
Route::get('/doctors/create', [DoctorController::class, 'create']); // Formulario de doctores
Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit']); // Formulario de Edicion de doctores
Route::post('/doctors', [DoctorController::class, 'store']); // Envio del Formulario de doctores
Route::put('/doctors/{doctor}', [DoctorController::class, 'update']); // Editar una Doctor
Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy']); // Eliminar una Doctor

// Clinic Histories
Route::get('/clinic_histories', [ClinicHistoryController::class, 'index']);
Route::get('/clinic_histories/create', [ClinicHistoryController::class, 'create']); // Formulario de historias clinicas
Route::get('/clinic_histories/{histories}/edit', [ClinicHistoryController::class, 'edit']); // Formulario de Edicion de historias clinicas
Route::post('/clinic_histories', [ClinicHistoryController::class, 'store']); // Envio del Formulario de historias clinicas
Route::put('/clinic_histories/{histories}', [ClinicHistoryController::class, 'update']); // Editar una historia clinica
Route::delete('/clinic_histories/{histories}', [ClinicHistoryController::class, 'destroy']); // Eliminar una historia clinica

// Calendario
Route::get('/schedule', [ScheduleController::class, 'edit']);
Route::post('/schedule', [ScheduleController::class, 'store']);

// Ruta para probar con Vue
Route::get('medical_appointments/get/specialtiesAll', [SpecialtyController::class, 'getSpecialties']);
Route::get('medical_appointments/get/doctors', [SpecialtyController::class, 'getDoctors']);
Route::get('medical_appointments/get/hours', [ScheduleController::class, 'hours']);

// Consulta Medica
Route::get('/medical_consultations', [MedicalConsultationController::class, 'index']);
Route::get('/medical_consultations_show', [MedicalConsultationController::class, 'index_show']);
