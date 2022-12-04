<?php namespace App\Services;

use App\Interfaces\ScheduleServiceInterface;
use App\Models\WorkDay;
use Carbon\Carbon;
use App\Models\MedicalAppointment;

class ScheduleService implements ScheduleServiceInterface
{

  public function isAvailableInterval($date, $doctorId, Carbon $start)
  {
    $exists = MedicalAppointment::where('doctor_id', $doctorId)
      ->where('schedule_date', $date)
      ->where('schedule_time', $start->format('H:i:s'))
      ->exists();

    return !$exists;  //available if already no exists
  }

  public function getAvailableIntervals($date, $doctorId)
  {
          //Traer el turno mañana y tarde de un medico determinado para una fecha determinada
          $workDay = WorkDay::where('active', true)
            ->where('day', $this->getDayFromDate($date))
            ->where('user_id', $doctorId)
            ->first([
              'morning_start','morning_end','afternoon_start','afternoon_end'
            ]);

          if($workDay){
            $morningStart = $workDay->morning_start;
            $morningEnd = $workDay->morning_end;

            $afternoonStart = $workDay->afternoon_start;
            $afternoonEnd = $workDay->afternoon_end;

            $morningIntervals = $this->getIntervals(
              $morningStart, $morningEnd,
              $date, $doctorId
            );

            $afternoonIntervals = $this->getIntervals(
              $afternoonStart, $afternoonEnd,
              $date, $doctorId
            );
          }else{
            $morningIntervals = [];
            $afternoonIntervals = [];
          }

          if ($morningIntervals == [] && $afternoonIntervals == []) {
            $data = [];
          }else{

            $data = [];
            $data['morning'] = $morningIntervals;
            $data['afternoon'] = $afternoonIntervals;
          }

          return $data;
  }

  private function getDayFromDate($date)
  {
      $dateCarbon = new Carbon($date);
      $i = $dateCarbon->dayOfWeek;
      $day = ($i==0 ? 6 : $i-1);
      return $day;
  }

  private function getIntervals($start, $end, $date, $doctorId)
  {

    $start = new Carbon($start);
    $end = new Carbon($end);

    $intervals = [];

    while ($start < $end ) {

        $interval = [];
        $interval ['start'] = $start->format('g:i A');

        //Cuando esta disponible una cita
        $available = $this->isAvailableInterval($date,$doctorId,$start);

        $start->addMinutes(30);
        $interval ['end'] = $start->format('g:i A');;

        if ($available) {
          $intervals [] = $interval;
        }
    }
    return $intervals;
  }

}
