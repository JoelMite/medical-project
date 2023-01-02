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
    public function index()
    {
        return Specialty::all(['id', 'name']);
    }

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

        //$doctor = User::findOrfail($user_id_pluck);
        //$persons = $doctor->person()->get(['name', 'lastname', 'user_id']);

        return $ens;
      }

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
