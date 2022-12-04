<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalConsultation extends Model
{
    use HasFactory;

    public $table = "medical_consultations";

    protected $fillable = [
        'reason', 'diagnosis', 'observations', 'blood_pressure', 'heart_rate',
        'breathing_frequency', 'weight', 'height', 'imc', 'abdominal_perimeter',
        'capillary_glucose', 'temperature', 'history_id', 'created_at',
    ];
}
