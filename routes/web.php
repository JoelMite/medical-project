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
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PdfController;

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
Route::post('/medical_appointments', [MedicalAppointmentController::class, 'store']);

// Doctors
Route::get('/doctors', [DoctorController::class, 'index']);
Route::get('/doctors/create', [DoctorController::class, 'create']); // Formulario de doctores
Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit']); // Formulario de Edicion de doctores
Route::post('/doctors', [DoctorController::class, 'store']); // Envio del Formulario de doctores
Route::put('/doctors/{doctor}', [DoctorController::class, 'update']); // Editar una Doctor
Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy']); // Eliminar una Doctor

// Clinic Histories
Route::get('/clinic_histories', [ClinicHistoryController::class, 'index']);
Route::get('/clinic_histories/{user}/create', [ClinicHistoryController::class, 'create']); // Formulario de historias clinicas
Route::get('/clinic_histories/{histories}/edit', [ClinicHistoryController::class, 'edit']); // Formulario de Edicion de historias clinicas
Route::post('/clinic_histories', [ClinicHistoryController::class, 'store']); // Envio del Formulario de historias clinicas
Route::put('/clinic_histories/{histories}', [ClinicHistoryController::class, 'update']); // Editar una historia clinica
Route::delete('/clinic_histories/{histories}', [ClinicHistoryController::class, 'destroy']); // Eliminar una historia clinica
Route::get('/clinic_histories/{history}', [ClinicHistoryController::class, 'show']); // Mostrar un HC

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
Route::get('/medical_consultations/{person}/create', [MedicalConsultationController::class, 'create']);
Route::post('/medical_consultations', [MedicalConsultationController::class, 'store']);

// Gestion de Citas Medicas Vue
Route::get('/appointment_medicals_patient', [MedicalAppointmentController::class, 'indexPatient']);
Route::get('/appointment_medicals_doctor', [MedicalAppointmentController::class, 'indexDoctor']);
Route::get('/indexpendingAppointments', [MedicalAppointmentController::class, 'indexPendingAppointments']);
Route::get('/indexconfirmedAppointments', [MedicalAppointmentController::class, 'indexConfirmedAppointments']);
Route::get('/indexoldAppointments', [MedicalAppointmentController::class, 'indexOldAppointments']);

Route::get('/appointment_medicals/{appointment}/cancel', [MedicalAppointmentController::class, 'showCancelForm']);
Route::post('/appointment_medicals/{appointment}/cancel', [MedicalAppointmentController::class, 'postCancel']);
Route::post('/appointment_medicals/{appointment}/confirm', [MedicalAppointmentController::class, 'postConfirm']);
Route::post('/appointment_medicals/{appointment}/attend', [MedicalAppointmentController::class, 'postAttend']);

// Gestion de Pacientes
Route::get('/patients', [PatientController::class, 'index']);
Route::get('/patients/create', [PatientController::class, 'create']); // Formulario de pacientes
Route::get('/patients/{patient}/edit', [PatientController::class, 'edit']); // Formulario de Edicion de pacientes
Route::post('/patients', [PatientController::class, 'store']); // Envio del Formulario de pacientes
Route::put('/patients/{patient}', [PatientController::class, 'update']); // Editar una paciente
Route::get('/patients/{patient}/state', [PatientController::class, 'state']); // Cambiar a activo o inactivo un paciente

// Ruta de Prueba para probarlo con vue
Route::get('/indexpendingAppointments', [MedicalAppointmentController::class, 'indexPendingAppointments']);
// Ruta de Prueba para probarlo con vue
Route::get('/indexconfirmedAppointments', [MedicalAppointmentController::class, 'indexConfirmedAppointments']);
// Ruta de Prueba para probarlo con vue
Route::get('/indexoldAppointments', [MedicalAppointmentController::class, 'indexOldAppointments']);

// Ruta de Prueba para probarlo con vue
Route::get('/count_patients', [PatientController::class, 'count_patients']);
// Ruta de Prueba para probarlo con vue
Route::get('/pendingAppointments', [MedicalAppointmentController::class, 'pendingAppointments']);
// Ruta de Prueba para probarlo con vue
Route::get('/confirmedAppointments', [MedicalAppointmentController::class, 'confirmedAppointments']);
// Ruta de Prueba para probarlo con vue
Route::get('/attendedAppointments', [MedicalAppointmentController::class, 'attendedAppointments']);

// Ruta de Prueba para probarlo con vue
Route::get('/count_users', [DoctorController::class, 'count_users']);
// Ruta de Prueba para probarlo con vue
Route::get('/bannedUsers', [DoctorController::class, 'bannedUsers']);
// Ruta de Prueba para probarlo con vue
Route::get('/activeUsers', [DoctorController::class, 'activeUsers']);

// PDF View Consultas Medicas
Route::get('/medical_consultations_pdf/{medical_consultations}', [PdfController::class, 'show']);
// PDF Download Consultas Medicas
Route::get('/medical_consultations_export_pdf/{medical_consultations}', [PdfController::class, 'export']);

