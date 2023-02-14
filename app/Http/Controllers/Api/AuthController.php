<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class AuthController extends Controller
{
  /**
   * Registro de usuario
   */

  // Todo Este ya no funcionaria porque es para registrar usuarios desde el movil. 
  public function signUp(Request $request)
  {
      $request->validate([
          'name' => 'required|string',
          'email' => 'required|string|email|unique:users',
          'password' => 'required|string'
      ]);

      User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password)
      ]);

      return response()->json([
          'message' => 'Successfully created user!'
      ], 201);
  }

  /**
   * Inicio de sesión y creación de token
   */
   
    /**
     * @OA\Post(
     *  path="/api/login",
     *   tags={"Login"},
     *   summary="Login",
     *   description="Iniciar sesión (crear el token)",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="True",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    
  public function login(Request $request)
  {

    $request->validate([
          'email' => 'required|string|email',
          'password' => 'required|string',
          'remember_me' => 'boolean'
      ]);

       $credentials = $request->only('email', 'password');
      //
      if (!Auth::attempt($credentials)){
        $success = false;
        $message = "Unauthorized";
          return compact('success', 'message');
      }

      $user = User::find(auth()->id());
      $name = User::find(auth()->id())->person->name;
      
      $patient = true;

      $access_token = $user->createToken('Personal Access Token')->plainTextToken;

      $success = true;

      // return compact('user', 'name', 'patient', 'access_token', 'success');

      return response()->json([
        'user' => $user,
        'name' => $name,
        'patient' => $patient,
        'access_token' => $access_token,
        'success' => $success
    ]);

  }

  /**
   * Cierre de sesión (anular el token)
   */


   /**
 * @OA\Post(
 *  path="/api/logout",
 *  summary="Logout",
 *  description="Cerrar sesión (anular el token)",
 *  operationId="authLogout",
 *  tags={"Logout"},
 *  security={ {"bearer_token": {} }},
 *  @OA\Response(
 *     response=200,
 *     description="Successfully logged out"
 *      ),
 *  @OA\Response(
 *     response=401,
 *     description="Returns when user is not authenticated",
 *     @OA\JsonContent(
 *        @OA\Property(property="message", type="string", example="Not authorized"),
 *     )
 *  )
 *  )
 **/

  public function logout(Request $request)
  {
      //$request->user()->token()->revoke();
      $request->user()->tokens()->delete();

      return response()->json([
          'message' => 'Successfully logged out'
      ]);
  }

  /**
   * Obtener el objeto Person como json
   */
  /* public function show()
  {
      return Auth::guard('api')->user()->person()->first();
  } */
}