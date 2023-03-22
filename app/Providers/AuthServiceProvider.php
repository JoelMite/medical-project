<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Person;
use App\Models\ClinicHistory;
use App\Models\MedicalConsultation;
use App\Models\MedicalAppointment;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::define('haveaccess', function (User $user, $perm){
            return $user->havePermission($perm);
        });

        Gate::define('haveaccessUser', function (User $usera, User $user, $perm){

            if ($usera->havePermission($perm)) {
              return $usera->id == $user->creator_id;
            }
            return false;
        });

        Gate::define('haveaccessHistoryClinic', function (User $usera, ClinicHistory $history, $perm){

            if ($usera->havePermission($perm)) {
              return $usera->id == $history->person->user->creator_id;
            }
            return false;
        });

        Gate::define('haveaccesscreateHistoryClinic', function (User $usera, User $user, $perm){

            if ($usera->havePermission($perm) && $user->havePermission('appointmentmedical.create')) {
              return $usera->id == $user->creator_id;
            }
            return false;
        });

        Gate::define('haveaccesscreateMedicalConsultations', function (User $usera, Person $person, $perm){

            if ($usera->havePermission($perm) && $person->user->havePermission('appointmentmedical.create')) {
              return $usera->id == $person->user->creator_id;
            }
            return false;
        });

        Gate::define('haveaccessShowMedicalConsultations', function (User $usera, MedicalConsultation $medical_consultations, $perm){

          if ($usera->havePermission($perm)) {
            return $usera->id == $medical_consultations->clinic_history->person->user->creator_id;
          }
          return false;
        });

        Gate::define('haveaccessCancelAppointment', function (User $usera, MedicalAppointment $appointment, $perm){

          if ($usera->havePermission($perm)) {
            return $usera->id == $appointment->doctor_id;
          }
          return false;
        });

        Gate::define('haveaccessConfirmAppointment', function (User $usera, MedicalAppointment $appointment, $perm){

          if ($usera->havePermission($perm)) {
            return $usera->id == $appointment->doctor_id;
          }
          return false;
        });


        // Gate::define('haveaccessshowAppointmentMedical', function (User $user, MedicalAppointment $appointment, $perm){

        //   if ($user->havePermission($perm[0]) && $user->havePermission($perm[1])) {
        //     return $user->id == $appointment->doctor_id;
        //   }
        //   return false;
        // });
    }
}
