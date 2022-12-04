<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();
         return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions_patient = Permission::where('name', 'LIKE', '%Paciente%')->where('name', 'NOT LIKE', '%Dashboard%')->orWhere('name', 'LIKE', '%Perfil%')->get(); // 4 resultados
        //$permissions_patient = $permissions_all->where('name', 'LIKE', '%paciente%')->orWhere('name', 'LIKE', '%perfil%')->get(); // 4 resultados
        $permissions_doctor = Permission::where('name', 'LIKE', '%Médico%')->where('name', 'NOT LIKE', '%Dashboard%')->orWhere('name', 'LIKE', '%Perfil%')->orWhere('name', 'LIKE', '%Horario%')->get(); // 6 resultados
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
