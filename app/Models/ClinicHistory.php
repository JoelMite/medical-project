<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicHistory extends Model
{
    use HasFactory;

    public $table = "clinic_histories";

    protected $fillable = [
        'personal_history', 'family_background', 'current_illness', 'habits', 'person_id',
    ];

    public function person(){
        return $this->belongsTo(Person::class);
    }
}
