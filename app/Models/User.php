<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\MyResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'creator_id', 
        'state'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function person(){
        return $this->hasOne(Person::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function specialties(){
        return $this->belongsToMany(Specialty::class)->withTimestamps();
    }

    public function asPatientAppointments(){
        return $this->hasMany(MedicalAppointment::class, 'patient_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    public function havePermission($permission){

        foreach ($this->roles as $role ) {

            foreach ($role->permissions as $perm) {

                if ($perm->slug == $permission ) {
                    return true;
                }
            }
        }
        return false;
    }
}
