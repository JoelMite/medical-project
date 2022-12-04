<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;

class SpecialtyController extends Controller
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
        $specialties = Specialty::all();
         return view('specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specialties.create');
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

    public function getDoctors(Request $request){
        if ($request->ajax()) {
          $specialty = Specialty::findOrfail($request->specialty_id);
          $user_id_pluck = $specialty->users()->pluck('users.id')->first();
          if (empty($user_id_pluck)) {
            return [];
          }else{

            //Podria ser Esto ////:) Ahi fue Joel Que bien.
            $ens = [];
            foreach ($specialty->users as $user) {
              $en = [];
               $en ['id']= $user['id'] ?? 'Desconocido';
               $en ['name']= $user->person['name'] ?? 'Desconocido';
               $en ['lastname']= $user->person['lastname'] ?? 'Desconocido';
               $en ['user_id']= $user->person['user_id'];

              $ens []= $en;
            }

            return response()->json($ens);
        }
      }
    }

    public function getSpecialties(){
        $specialties = Specialty::all();
        return response()->json($specialties);
    }
}
