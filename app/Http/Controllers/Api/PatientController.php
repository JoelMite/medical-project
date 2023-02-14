<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PatientController extends Controller
{

    /**
    * @OA\Get(
    *     path="/api/person",
    *     tags={"Person"},
    *     summary="Información basica del paciente.",
    *   @OA\Response(
     *      response=200,
     *       description="Listar toda aquella información que sea relevante para el médico.",
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
     *      ),
    *      security={
    *         {"bearer_token": {}}
    *     },
    * )
    */

    public function show()
    {
        return auth('sanctum')->user()->person()->first();
    }

    /**
     * @OA\Post(
     *  path="/api/person",
     *   tags={"Person"},
     *   summary="Actualizar datos del paciente",
     *   operationId="update",
     *      security={
     *         {"bearer_token": {}}
     *     },
     *
     *   @OA\Parameter(
     *      name="address",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="city",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="phone",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="date_birth",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Datos del Paciente Actualizados.",
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
     *  )
     **/

    public function update(Request $request)
    {
        $user = Auth::guard('sanctum')->user()->person()->first();
        $user->address = $request->address;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->date_birth = $request->date_birth;
        $user->save();

        return response()->json([
            'message' => 'Datos del Paciente Actualizados.'
        ]);
    }

}