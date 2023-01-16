<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ScheduleServiceInterface;

use App\Models\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
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