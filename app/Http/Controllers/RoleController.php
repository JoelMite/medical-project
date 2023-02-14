<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Carbon\Carbon;


class RoleController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();
         return view('roles.index', compact('roles'));
    }

   
    public function create()
    {
        $permissions_patient = Permission::where('name', 'LIKE', '%Paciente%')->where('name', 'NOT LIKE', '%Dashboard%')->orWhere('name', 'LIKE', '%Perfil Paciente%')->get(); // 4 resultados
        //$permissions_patient = $permissions_all->where('name', 'LIKE', '%paciente%')->orWhere('name', 'LIKE', '%perfil%')->get(); // 4 resultados
        $permissions_doctor = Permission::where('name', 'LIKE', '%Médico%')->where('name', 'NOT LIKE', '%Dashboard%')->orWhere('name', 'LIKE', '%Perfil Médico%')->orWhere('name', 'LIKE', '%Horario%')->get(); // 6 resultados
        $permissions_role = Permission::where('name', 'LIKE', '%Rol%')->get(); // 4 resultados
        $permissions_specialty = Permission::where('name', 'LIKE', '%Especialidad%')->get(); // 4 resultados
        $permissions_user = Permission::where('name', 'LIKE', '%Usuario%')->get(); // 2 resultados
        $permissions_history_clinic = Permission::where('name', 'LIKE', '%Clínica%')->get(); // 4 resultados
        $permissions_consultation_appointment_medical = Permission::where('name', 'LIKE', '%Médica%')->where('name', 'NOT LIKE', '%(Paciente)%')
        ->where('name', 'NOT LIKE', '%Pacientes%')->get(); // 9 resultados
        $permissions_dashboard = Permission::where('name', 'LIKE', '%Dashboard%')->get(); // 2 resultados

        //return $permissions_patient;
        return view('roles.create', compact('permissions_patient', 'permissions_doctor', 'permissions_role', 'permissions_specialty', 'permissions_user', 'permissions_history_clinic', 'permissions_consultation_appointment_medical', 'permissions_dashboard'));
    }

    
    //  Metodo POST Insertar Roles
    public function store(Request $request){
        //dd($request->all());
        $this->validation($request);
  
        //return $request;
  
        //  Insertar Rol
        $role = new Role();
        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->save(); // Insertar
  
        // Insertar el rol con su permiso
        $role->permissions()->sync($request->input('permissions'));
  
        $success = "El rol se ha registrado correctamente.";
        return redirect('/roles')->with(compact('success'));
    }

   
    public function edit(Role $role)
    {
        $permissions_patient = Permission::where('name', 'LIKE', '%Paciente%')->where('name', 'NOT LIKE', '%Dashboard%')->orWhere('name', 'LIKE', '%Perfil Paciente%')->get(); // 4 resultados
        $permissions_doctor = Permission::where('name', 'LIKE', '%Médico%')->where('name', 'NOT LIKE', '%Dashboard%')->orWhere('name', 'LIKE', '%Perfil Médico%')->orWhere('name', 'LIKE', '%Horario%')->get(); // 6 resultados
        $permissions_role = Permission::where('name', 'LIKE', '%Rol%')->get(); // 4 resultados
        $permissions_specialty = Permission::where('name', 'LIKE', '%Especialidad%')->get(); // 4 resultados
        $permissions_user = Permission::where('name', 'LIKE', '%Usuario%')->get(); // 2 resultados
        $permissions_history_clinic = Permission::where('name', 'LIKE', '%Clínica%')->get(); // 4 resultados
        $permissions_consultation_appointment_medical = Permission::where('name', 'LIKE', '%Médica%')->where('name', 'NOT LIKE', '%(Paciente)%')
        ->where('name', 'NOT LIKE', '%Pacientes%')->get(); // 9 resultados
        $permissions_dashboard = Permission::where('name', 'LIKE', '%Dashboard%')->get(); // 2 resultados

        $permissions_patient_id = $role->permissions()->where(function ($query) {
        $query->where('name', 'LIKE', '%Paciente%')
        ->where('name', 'NOT LIKE', '%Dashboard%')
        ->orWhere('name', 'LIKE', '%Perfil Paciente%');
        })->pluck('permissions.id');

        $permissions_doctor_id = $role->permissions()->where(function ($query) {
        $query->where('name', 'LIKE', '%Médico%')
        ->where('name', 'NOT LIKE', '%Dashboard%')
        ->orWhere('name', 'LIKE', '%Perfil Médico%')
        ->orWhere('name', 'LIKE', '%Horario%');
        })->pluck('permissions.id');

        $permissions_role_id = $role->permissions()->where(function ($query) {
        $query->where('name', 'LIKE', '%Rol%');})->pluck('permissions.id');

        $permissions_specialty_id = $role->permissions()->where(function ($query) {
        $query->where('name', 'LIKE', '%Especialidad%');})->pluck('permissions.id');

        $permissions_user_id = $role->permissions()->where(function ($query) {
        $query->where('name', 'LIKE', '%Usuario%');})->pluck('permissions.id');

        $permissions_history_clinic_id = $role->permissions()->where(function ($query) {
        $query->where('name', 'LIKE', '%Clínica%');})->pluck('permissions.id');

        $permissions_consultation_appointment_medical_id = $role->permissions()->where(function ($query) {
        $query->where('name', 'LIKE', '%Médica%')->where('name', 'NOT LIKE', '%(Paciente)%')
        ->where('name', 'NOT LIKE', '%Pacientes%');})->pluck('permissions.id');

        $permissions_dashboard_id = $role->permissions()->where(function ($query) {
        $query->where('name', 'LIKE', '%Dashboard%');})->pluck('permissions.id');

        // $permissions_patients = $role::whereHas('permissions')->get();

        $time_now = Carbon::now(); // Tiempo Actual
        $time_update = Carbon::parse($role->created_at)->floatDiffInDays($time_now->toDateTimeString());
        if ($time_update <= 0.25) { 
            // Tiempo para actualizar maximo 6 horas
            //return dd($permissions_doctor_id);
            return view('roles.edit', compact('role', 'permissions_patient', 'permissions_doctor',
            'permissions_role', 'permissions_specialty', 'permissions_user', 'permissions_history_clinic',
            'permissions_consultation_appointment_medical', 'permissions_dashboard','permissions_patient_id', 'permissions_doctor_id',
            'permissions_role_id', 'permissions_specialty_id', 'permissions_user_id', 'permissions_history_clinic_id',
            'permissions_consultation_appointment_medical_id', 'permissions_dashboard_id'));
        }else{
            $warning = "El rol no se puede actualizar porque ha caducado el limite de tiempo.";
            return redirect('/roles')->with(compact('warning'));
            // return dd($rol);
        }
    }

    //  Metodo Validacion
    private function validation(Request $request){
        //  Validar a los datos del formulario rol a nivel de servidor
        $rules = [
          'name' => 'required',
          'description' => 'required',
          'permissions' => 'required'
        ];
        $messages = [
          'name.required' => 'Es necesario ingresar un nombre.',
          'description.required' => 'Es necesario ingresar una descripción.',
          'permissions.required' => 'Es necesario ingresar por lo menos un permiso.'
        ];
        $this->validate($request, $rules, $messages);
    }

    
    public function update(Request $request, Role $role)
    {
        //dd($request->all());
        $this->validation($request);

        //  Editar Rol
        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->save(); // Editar

        $role->permissions()->sync($request->input('permissions'));

        $success = "El rol se ha actualizado correctamente.";
        return redirect('/roles')->with(compact('success'));
    }

    
}
