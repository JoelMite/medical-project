<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('getLogout');
    }

    public function getLogin()
    {
      return view('auth.login');
    }
    public function postLogin(Request $request)
    {
      $rules = [
        'email' => 'required|email',
        'password' => 'required'
      ];

      $messages = [
        'email.required' => 'Es necesario ingresar un correo.',
        'password.required' => 'Es necesario ingresar una contraseña.',
      ];

      $mensaje = "Ingresado correctamente";

      $validator = Validator::make($request->all(), $rules, $messages);

      if ($validator->fails()) { // Verificamos que si el validator falla returne con los errores del validator y los datos de los input se mantengan y se han enviados al helper old
        return back()->withErrors($validator)->withInput();
      }else{
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) { // El true me indica que va a tener la sesion guardada durante un año
          
          if (Auth::user()->state == "403") {
            return redirect('/logout');
          }else{
            $message = "Su usuario ha sido suspendido. Contáctese con el administrador.";
            return redirect('/')->with(compact('message'));
          }

        }else{
          $message = "El correo electrónico o la contraseña estan incorrectos.";
          return back()->with(compact('message'));
        }
        // return dd($mensaje);
      }
    }
    public function getLogout()
    {
      $state = Auth::user()->state;
      Auth::logout();
      if ($state == "403") {
        $message = "Su usuario ha sido suspendido. Contáctese con el administrador.";
        return redirect('/login')->with(compact('message'));
      }
      return redirect('/');
    }
}
