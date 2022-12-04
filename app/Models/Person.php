<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    public $table = "persons";

    protected $fillable = [
        'name', 'lastname', 'dni', 'phone', 'address', 'city', 'date_birth', 'age', 'etnia', 'sex', 'user_id',
      ];

    public function clinic_history(){
    return $this->hasOne(ClinicHistory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
