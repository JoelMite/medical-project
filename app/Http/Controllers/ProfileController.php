<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
     
    public function show(){
    
        //Gate::authorize('haveaccess','profile.show');
    
        $user = auth()->user();
        $person = $user->person;
        $roles = $user->roles;  
        $date_b = $user->person->date_birth;
        $date_birth = Carbon::parse($date_b)->locale('es')->settings(['formatFunction' => 'isoFormat'])->format('LL');
    
        //return dd($user, $person, $date_birth);
    
        return view('profile.index', compact('user', 'person', 'roles', 'date_birth'));
    }

    public function update(Request $request, User $user){
        //  Validar a los datos del formulario doctor a nivel de servidor
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'phone' => 'required|max:15',
            'address' => 'required',
            'city' => 'required',
            'date_birth' => 'required|date',
    
            ];
            $messages = [
            'name.required' => 'Es necesario ingresar los nombres.',
            'lastname.required' => 'Es necesario ingresar los apellidos.',
            'email.required' => 'Es necesario ingresar un correo.',
            'email.email' => 'Es necesario ingresar un correo válido.',
            'password.required' => 'Es necesario ingresar una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'phone.required' => 'Es necesario ingresar un telefono.',
            'phone.max' => 'El número telefónico no puede exceder los 15 dígitos.',
            'address.required' => 'Es necesario ingresar una direccion.',
            'city.required' => 'Es necesario ingresar una ciudad.',
            'date_birth.required' => 'Es necesario ingresar una fecha de nacimiento.',
            'date_birth.date' => 'Es necesario ingresar una fecha de nacimiento válida.',
            ];
            $this->validate($request, $rules, $messages);
    
            $date_birth = Carbon::parse($request['date_birth'])->age;
    
            $user->email = $request->input('email');
            $password = $request->input('password');
    
            if ($password)
            $user->password = bcrypt($request->input('password'));
    
            $user->save(); // Editar
    
            $person = $user->person;
    
            $person->name = $request->name;
            $person->lastname = $request->lastname;
            $person->phone = $request->phone;
            $person->address = $request->address;
            $person->city = $request->city;
            $person->date_birth = $request->date_birth;
            $person->age = $date_birth;
    
            $person->save();
    
            $success = "Su perfil se ha actualizado correctamente.";
            return redirect('/user/profile')->with(compact('success'));
    }
}
