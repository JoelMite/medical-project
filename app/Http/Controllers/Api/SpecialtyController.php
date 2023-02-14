<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialty;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
    * @OA\Get(
    *     path="/api/specialties",
    *     tags={"Specialties"},
    *     summary="Mostrar todas las especialidades",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos las especialidades disponibles en el sistema."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */

    public function index()
    {
        return Specialty::all(['id', 'name']);
    }


    /**
 * @OA\Get(
 * path="/api/specialties/{specialty}/doctors",
 * summary="Lista de doctores relaciondos con una especialidad",
 * description="Obtiene todos los doctores que estan relacionados con una especialidad",
 * operationId="getDoctors",
 * tags={"Specialties-Doctors"},
 * @OA\Parameter(
 *    description="ID de Especialidad",
 *    in="path",
 *    name="specialty",
 *    required=true,
 *    example="1",
 *    @OA\Schema(
 *       type="integer",
 *       format="int64"
 *    )
 * ),
 * @OA\Response(
    *         response=200,
    *         description="Mostrar todos los doctores que estan asociados a una especialidad."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
 * )
 */
    public function doctors($id)
    {
      
      $specialty = Specialty::findOrfail($id);
      $user_id_pluck = $specialty->users()->pluck('users.id')->first();
      if (empty($user_id_pluck)) {
        return [];
      }else{

        $ens = [];
        foreach ($specialty->users as $user) {
          $en = [];
           $en ['id']= $user['id'] ?? 'Desconocido';
           $en ['name']= $user->person['name'] ?? 'Desconocido';
           $en ['lastname']= $user->person['lastname'] ?? 'Desconocido';
           $en ['user_id']= $user->person['user_id'];

          $ens []= $en;
        }

        return $ens;
      }

    }
}
