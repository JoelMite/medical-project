<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_of_exam', 'quantity', 'assessment', 'observations_pru', 'medical_consultation_id',
    ];
    
      public function medical_consultation(){
        return $this->belongsTo(MedicalConsultation::class);
    }
}
