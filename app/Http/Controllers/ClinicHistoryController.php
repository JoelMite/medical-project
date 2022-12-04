<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class ClinicHistoryController extends Controller
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

      $havePersonHistory = Person::has('clinic_history')->whereHas('user', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
        $query->where('creator_id','=',auth()->id())
          ->whereHas('roles', function($query){
            $query->whereHas('permissions', function($query){
              $query->where('name','=','Crear Cita Médica');
            });
          });
        })->with('history_clinic:person_id,id')->get(['id', 'name', 'lastname']);
  
        $nohavePersonHistory = Person::doesntHave('clinic_history')->whereHas('user', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
          $query->where('creator_id','=',auth()->id())
            ->whereHas('roles', function($query){
              $query->whereHas('permissions', function($query){
                $query->where('name','=','Crear Cita Médica');
              });
            });
        })->get(['name', 'lastname', 'user_id']);
  
        return view('clinic_histories.index', compact('havePersonHistory', 'nohavePersonHistory'));

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
        //
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
    public function edit($id)
    {
        //
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
}
