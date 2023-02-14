<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ScheduleServiceInterface;

use App\Models\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{

    /**
    * @OA\Get(
    *     path="/api/schedule/hours",
    *     tags={"Schedule"},
    *     summary="Mostrar el horario de un médico",
    *   @OA\Parameter(
     *      name="date",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="doctor_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *   ),
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar el horario de trabajo del médico."
    *     ),
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
    * )
    */

    public function hours(Request $request, ScheduleServiceInterface $scheduleService){

      //dd($request->all());
      $rules = [
          'date' => 'required|date_format:"Y-m-d"',
          'doctor_id' => 'required|exists:users,id'
      ];

      $this->validate($request, $rules);

      $date = $request->input('date');
      //$day = $dateCarbon->dayOfWeek;
      //dd($day);
      $doctorId = $request->input('doctor_id');

      return $scheduleService->getAvailableIntervals($date, $doctorId);

        /*$table->unsignedSmallInteger('day');
        $table->boolean('active');

        $table->time('morning_start');
        $table->time('morning_end');

        $table->time('afternoon_start');
        $table->time('afternoon_end');

        $table->unsignedBigInteger('user_id');*/
    }

}