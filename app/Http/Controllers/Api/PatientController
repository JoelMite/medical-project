<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{

    public function show()
    {
        return Auth::guard('api')->user()->person()->first();
    }

    public function update(Request $request)
    {
        $user = Auth::guard('api')->user()->person()->first();
        $user->address = $request->address;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->date_birth = $request->date_birth;
        $user->save();
    }

}