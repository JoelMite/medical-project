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
        'capillary_glucose', 'temperature', 'clinic_history_id', 'created_at',
    ];

    public function medical_prescriptions(){
        return $this->hasMany(MedicalPrescription::class);
    }
    
      public function lab_tests(){
        return $this->hasMany(LabTest::class);
    }
    
      public function clinic_history(){
        return $this->belongsTo(ClinicHistory::class);
    }
    
      public function person(){
        return $this->belongsTo(Person::class); // Practicamente esto no funcionaria
    }
}
