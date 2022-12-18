<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Specialty;
use Carbon\Carbon;

class DoctorController extends Controller
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
        //$doctores = User::has('rols')->get();  //  Practicamente me devuelve todos los usuarios asociados a un rol
        $doctores = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
        $query->where('creator_id','=',auth()->id());
        })->get();
        return view('doctors.index', compact('doctores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $specialties = Specialty::all();
        return view('doctors.create', compact('roles', 'specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        //  Insertar Doctor o Usuario
        // Nos aseguramos de capturar solamente la informacion que se espera del formulario
        $user = User::create([
            'email' => $request->input('email'),
            'password'=>bcrypt($request->input('password')),
            'creator_id'=>auth()->id(),
            'state'=>'200'
        ]);

        $user->specialties()->attach($request->input('specialties'));
        $user->roles()->attach($request->input('roles'));
  
        $date_birth = Carbon::parse($request['date_birth'])->age; // Utilizo Carbon para calcular la edad a partir de la fecha de nacimiento
  
        $user->person()->create([
          'name' => $request['name'],
          'lastname' => $request['lastname'],
          'dni' => $request['dni'],
          'phone' => $request['phone'],
          'address' => $request['address'],
          'city' => $request['city'],
          'etnia' => $request['etnia'],
          'date_birth' => $request['date_birth'],
          'age' => $date_birth,
          'sex' => $request['sex'],
        ]);
  
        $success = "El usuario se ha registrado correctamente.";
        return redirect('/doctors')->with(compact('success'));
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

     //  Metodo Validacion
     private function validation(Request $request){
        //  Validar a los datos del formulario doctor a nivel de servidor
        $rules = [
          'name' => 'required',
          'lastname' => 'required',
          // 'dni' => 'bail|required|unique:persons,dni|ecuador:ci|digits:10',
          'dni' => 'bail|required|ecuador:personal_identification|digits:10',
          // 'email' => 'required|unique:users,email|email',
          'email' => 'required|email',
          'password' => 'required|min:6',
          'specialties' => 'required|array',
          'phone' => 'required|max:15',
          'address' => 'required',
          'city' => 'required',
          'etnia' => 'required',
          'date_birth' => 'required|date',
          'sex' => 'required',
          'roles' => 'required|array'
 
        ];
        $messages = [
          'name.required' => 'Es necesario ingresar los nombres.',
          'lastname.required' => 'Es necesario ingresar los apellidos.',
          'dni.required' => 'Es necesario ingresar un DNI.',
          // 'dni.unique' => 'Este DNI ya se encuentra registrado.',
          'dni.ecuador' => 'El DNI que ha ingresado es invalido.',
          'dni.digits' => 'El DNI que tiene que tener exactamente 10 dígitos.',
          'email.required' => 'Es necesario ingresar un correo.',
          // 'email.unique' => 'Este email ya se encuentra registrado.',
          'email.email' => 'Es necesario ingresar un correo válido.',
          'password.required' => 'Es necesario ingresar una contraseña.',
          'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
          'specialties.required' => 'Es necesario ingresar por lo menos una especialidad.',
          'phone.required' => 'Es necesario ingresar un teléfono.',
          'phone.max' => 'El número telefónico no puede exceder los 15 dígitos.',
          'address.required' => 'Es necesario ingresar una direccion.',
          'city.required' => 'Es necesario ingresar una ciudad.',
          'etnia.required' => 'Es necesario ingresar una etnia.',
          'date_birth.required' => 'Es necesario ingresar una fecha de nacimiento.',
          'date_birth.date' => 'Es necesario ingresar una fecha de nacimiento válida.',
          'sex.required' => 'Es necesario ingresar un sexo.',
          'roles.required' => 'Es necesario ingresar por lo menos un rol.'
        ];
        $this->validate($request, $rules, $messages);
      }
}
