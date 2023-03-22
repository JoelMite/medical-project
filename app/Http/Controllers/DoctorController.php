<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('haveaccess','doctor.index');
        
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
        Gate::authorize('haveaccess','doctor.create');

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
    public function store(Request $request, User $user)
    {
        $this->validation($request);

        //  Insertar Doctor o Usuario
        // Nos aseguramos de capturar solamente la informacion que se espera del formulario
        // $user = User::create([
        //     'email' => $request->input('email'),
        //     'password'=>bcrypt($request->input('password')),
        //     'creator_id'=>auth()->id(),
        //     'state'=>'200'
        // ]);

        $password = $request->input('password');

        if (!$password){
          $warning = "El usuario necesita tener una contraseña.";
          return redirect()->back()->with(compact('warning'));
        }

        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->creator_id = auth()->id();
        $user->state = '200';

        $specialties = $request->input('specialties');
        $roles = in_array('2', $request->input('roles'));

        if ($roles){
          if ($specialties){
            $user->save();
            $user->roles()->attach($request->input('roles'));
            $user->specialties()->attach($request->input('specialties'));
          }else{
            $warning = "El médico necesita tener al menos una especialidad.";
            return redirect()->back()->with(compact('warning'));
          }
        }else{
          $user->save();
          $user->roles()->attach($request->input('roles'));
        }

        // if ($specialties && $roles)
        // $user->specialties()->attach($request->input('specialties'));
        
        // $user->roles()->attach($request->input('roles'));
  
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
    public function show(User $doctor)
    {
      Gate::authorize('haveaccessUser',[$doctor, 'doctor.show']);

      $roles = $doctor->roles;                //  Me devuelve el rol que cumple cada usuario(medico o administrador)
      $person = $doctor->person;
      $specialties = $doctor->specialties;
      
      // return dd($roles, $person);

      return view('doctors.show', compact('doctor', 'roles', 'specialties', 'person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $doctor)
    {
        Gate::authorize('haveaccessUser',[$doctor, 'doctor.edit']);
        //$doctor = User::findOrfail($id);
        $specialties = Specialty::all();

        $specialty_ids = $doctor->specialties()->pluck('specialties.id');   // Me devuelve un array de solo los ids de las especialidades que tienen relacion con usuarios
        $role_ids = $doctor->roles()->pluck('roles.id');

        // return $role_ids;

        $roles = Role::all();
        $persons = $doctor->person;
        return view('doctors.edit', compact('doctor', 'specialties', 'roles', 'persons', 'specialty_ids', 'role_ids'));
        //return(dd($persons));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $doctor)
    {
        $this->validation($request);

        $date_birth = Carbon::parse($request['date_birth'])->age;

        $doctor->email = $request->input('email');
        $password = $request->input('password');

        if ($password)
        $doctor->password = bcrypt($request->input('password'));

        $specialties = $request->input('specialties');
        $roles = in_array('2', $request->input('roles'));

        //return dd($roles);

        if ($roles){
          if ($specialties){
            $doctor->save();
            $doctor->roles()->sync($request->input('roles'));
            $doctor->specialties()->sync($request->input('specialties'));
          }else{
            $warning = "El médico necesita tener al menos una especialidad.";
            return redirect()->back()->with(compact('warning'));
          }
        }else{
          $doctor->save();
          $doctor->specialties()->detach();
          $doctor->roles()->sync($request->input('roles'));
        }

        $person = $doctor->person;

        $person->name = $request->name;
        $person->lastname = $request->lastname;
        $person->dni = $request->dni;
        $person->phone = $request->phone;
        $person->address = $request->address;
        $person->city = $request->city;
        $person->etnia = $request->etnia;
        $person->date_birth = $request->date_birth;
        $person->age = $date_birth;
        $person->sex = $request->sex;

        $person->save();

        $success = "El usuario se ha actualizado correctamente.";
        return redirect('/doctors')->with(compact('success'));
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
          // 'password' => 'required|min:6',
          // 'specialties' => 'required|array',
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
          // 'password.required' => 'Es necesario ingresar una contraseña.',
          // 'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
          // 'specialties.required' => 'Es necesario ingresar por lo menos una especialidad.',
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

      public function state(User $doctor)
    {
      Gate::authorize('haveaccessUser',[$doctor, 'user.state']);

      //dd($request->all());
      //$doctor = User::findOrfail($id);
      if($doctor->state == "403"){
        $doctor->state = "200";
        $success = "El usuario a sido activado";
      }
      elseif($doctor->state == "200"){
        $doctor->state = "403";
        $success = "El usuario a sido baneado";
      }
        if ($doctor->save()){ // Editar
        return redirect('/doctors')->with(compact('success'));
        // return dd($notification);
      }
    }

    public function count_users(){

      Gate::authorize('haveaccess','administrator.dashboard');

      $user = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol medico
      $query->where('name', 'Medico')->where('creator_id','=',auth()->id());
      })->count();
      return response()->json($user);

    }

    public function activeUsers(){

      Gate::authorize('haveaccess','administrator.dashboard');

      $user = User::whereHas('roles', function($query){ 
      $query->where('name', 'Medico')->where('creator_id','=',auth()->id())->where('state', '200');
      })->count();
      return response()->json($user);

    }

    public function bannedUsers(){

      Gate::authorize('haveaccess','administrator.dashboard');

      $user = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
      $query->where('name', 'Medico')->where('creator_id','=',auth()->id())->where('state', '403');
      })->count();
      return response()->json($user);

    }
}
