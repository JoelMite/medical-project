<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkDay;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $days = [
        'Lunes', 'Martes', 'Miercoles',
        'Jueves', 'Viernes', 'Sabado', 'Domingo'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $active = $request->input('active') ?: [];
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        $errors = [];

        for ($i = 0; $i < 7; ++$i) {
            if ($morning_start[$i] > $morning_end[$i]) {
                $errors[] = "Las horas del turno de la mañana son inconsistentes para el dia " . $this->days[$i] . '.';
            }
            if ($afternoon_start[$i] > $afternoon_end[$i]) {
                $errors[] = "Las horas del turno de la tarde son inconsistentes para el dia" . $this->days[$i] . '.';
            }
            WorkDay::updateOrCreate([
                'day' => $i,
                'user_id' => auth()->id(),
            ], [
                'active' => in_array($i, $active),

                'morning_start' => $morning_start[$i],
                'morning_end' => $morning_end[$i],

                'afternoon_start' => $afternoon_start[$i],
                'afternoon_end' => $afternoon_end[$i],
            ]);
        }
        if (count($errors) > 0) {
            return back()->with(compact('errors'));
        }

        $notification = 'Los cambios se han guardado correctamente';
        return back()->with(compact('notification'));
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
    public function edit()
    {
        $workDays = WorkDay::where('user_id', auth()->id())->get();

        if (count($workDays) > 0){

            $workDays->map(function($workDay){
            $workDay->morning_start = (new Carbon($workDay->morning_start))->format('g:i A');
            $workDay->morning_end = (new Carbon($workDay->morning_end))->format('g:i A');
            $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A');
            $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A');
            return $workDay;
            });
        }else{
            $workDays = collect();
            for ($i=0; $i < 7 ; $i++) {
            $workDays->push(new WorkDay());
            }
        }

        //return redirect(dd($workDays));
        $days = $this->days;
        return view('schedule',compact('workDays','days'));
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

    public function hours(Request $request, ScheduleServiceInterface $scheduleService){

        if ($request->ajax()) {
          //dd($request->all());
          $rules = [
              'date' => 'required|date_format:"Y-m-d"',
              'doctor_id' => 'required|exists:users,id'
          ];
  
          $this->validate($request, $rules);
  
          $date = $request->date;
          //$day = $dateCarbon->dayOfWeek;
          //dd($day);
          $doctorId = $request->doctor_id;
  
          return response()->json($scheduleService->getAvailableIntervals($date, $doctorId));
  
            /*$table->unsignedSmallInteger('day');
            $table->boolean('active');
  
            $table->time('morning_start');
            $table->time('morning_end');
  
            $table->time('afternoon_start');
            $table->time('afternoon_end');
  
            $table->unsignedBigInteger('user_id');*/
          }
      }

}
