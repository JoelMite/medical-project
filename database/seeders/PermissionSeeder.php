<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permission history clinic
        // 1
        $permission = Permission::create([
            'name' => 'Listar Historias Clínicas',
            'slug' => 'historyclinic.index',
            'description' => 'El usuario puede listar las historias clínicas.',
        ]);

        // 2
        $permission = Permission::create([
            'name' => 'Ver Historias Clínicas',
            'slug' => 'historyclinic.show',
            'description' => 'El usuario puede ver la info de las historias clínicas.',
        ]);

        // 3
        $permission = Permission::create([
            'name' => 'Crear Historia Clínica',
            'slug' => 'historyclinic.create',
            'description' => 'El usuario puede crear una historia clínica.',
        ]);

        // 4
        $permission = Permission::create([
            'name' => 'Editar Historia Clínica',
            'slug' => 'historyclinic.edit',
            'description' => 'El usuario puede editar la info de una historia clínica.',
        ]);

        //permission medical consultation
        // 5
        $permission = Permission::create([
            'name' => 'Listar Pacientes con Consultas Médicas',
            'slug' => 'medicalconsultation.index',
            'description' => 'El usuario puede listar a las personas que pueden acceder a una consulta médica.',
        ]);

        // Agregado
        // 6
        $permission = Permission::create([
            'name' => 'Listar Consultas Médicas',
            'slug' => 'medicalconsultation.indexShow',
            'description' => 'El usuario puede listar las consultas médicas que han sido creadas.',
        ]);

        //
        // 7
        /* $permission = Permission::create([
        'name' => 'Mostrar Consultas Médicas',
        'slug' => 'medicalconsultation.show',
        'description' => 'El usuario puede ver la info de las consultas médicas.',
        ]); */

        // 7
        $permission = Permission::create([
            'name' => 'Crear Consulta Médica',
            'slug' => 'medicalconsultation.create',
            'description' => 'El usuario puede crear una consulta médica.',
        ]);

        // 9
        /* $permission = Permission::create([
        'name' => 'Editar Consulta Médica',
        'slug' => 'medicalconsultation.edit',
        'description' => 'El usuario puede editar la info de una consulta médica.',
        ]); */

        //permission schedule attention
        // 8
        $permission = Permission::create([
            'name' => 'Gestionar Horario',
            'slug' => 'schedule.edit',
            'description' => 'El usuario puede gestionar su horario de atención.',
        ]);

        //permission appointment
        // 9
        $permission = Permission::create([
            'name' => 'Listar Citas Médicas (Doctor)',
            'slug' => 'appointmentmedicalDoctor.index',
            'description' => 'El usuario puede listar el historial de todas sus citas médicas.',
        ]);

        // 10
        $permission = Permission::create([
            'name' => 'Listar Citas Médicas (Paciente)',
            'slug' => 'appointmentmedicalPatient.index',
            'description' => 'El usuario puede listar el historial de todas sus citas médicas.',
        ]);

        // 11
        $permission = Permission::create([
            'name' => 'Ver Cita Médica',
            'slug' => 'appointmentmedical.show',
            'description' => 'El usuario puede ver la info de las citas médicas.',
        ]);

        // 12
        $permission = Permission::create([
            'name' => 'Crear Cita Médica',
            'slug' => 'appointmentmedical.create',
            'description' => 'El usuario puede crear una cita médica.',
        ]);

        // 13
        $permission = Permission::create([
            'name' => 'Confirmar Cita Médica',
            'slug' => 'appointmentmedical.postConfirm',
            'description' => 'El usuario puede confirmar la atención de una cita médica.',
        ]);

        // 14
        $permission = Permission::create([
            'name' => 'Cancelar Cita Médica',
            'slug' => 'appointmentmedical.showCancelForm',
            'description' => 'El usuario puede cancelar una cita médica.',
        ]);

        //permission user doctor
        // 15
        $permission = Permission::create([
            'name' => 'Listar Médicos',
            'slug' => 'doctor.index',
            'description' => 'El usuario puede listar los médicos.',
        ]);

        // 16
        $permission = Permission::create([
            'name' => 'Ver Médicos',
            'slug' => 'doctor.show',
            'description' => 'El usuario puede ver la info de los médicos.',
        ]);

        // 17
        $permission = Permission::create([
            'name' => 'Crear Médico',
            'slug' => 'doctor.create',
            'description' => 'El usuario puede crear un médico.',
        ]);

        // 18
        $permission = Permission::create([
            'name' => 'Editar Médico',
            'slug' => 'doctor.edit',
            'description' => 'El usuario puede editar la info de un médico.',
        ]);

        //permission user patient
        // 19
        $permission = Permission::create([
            'name' => 'Listar Pacientes',
            'slug' => 'patient.index',
            'description' => 'El usuario puede listar los pacientes.',
        ]);

        // 20
        $permission = Permission::create([
            'name' => 'Ver Pacientes',
            'slug' => 'patient.show',
            'description' => 'El usuario puede ver la info de los pacientes.',
        ]);

        // 21
        $permission = Permission::create([
            'name' => 'Crear Paciente',
            'slug' => 'patient.create',
            'description' => 'El usuario puede crear un paciente.',
        ]);

        // 22
        $permission = Permission::create([
            'name' => 'Editar Paciente',
            'slug' => 'patient.edit',
            'description' => 'El usuario puede editar la info de un paciente .',
        ]);

        //permission profile
        // 23
        $permission = Permission::create([
            'name' => 'Ver Perfil',
            'slug' => 'profile.show',
            'description' => 'El usuario puede ver su perfil.',
        ]);

        //permission role
        // 24
        $permission = Permission::create([
            'name' => 'Listar Roles',
            'slug' => 'role.index',
            'description' => 'El usuario puede listar los roles.',
        ]);

        // 25
        $permission = Permission::create([
            'name' => 'Ver Roles',
            'slug' => 'role.show',
            'description' => 'El usuario puede ver la info de los roles.',
        ]);

        // 26
        $permission = Permission::create([
            'name' => 'Crear Rol',
            'slug' => 'role.create',
            'description' => 'El usuario puede crear un rol.',
        ]);

        // 27
        $permission = Permission::create([
            'name' => 'Editar Rol',
            'slug' => 'role.edit',
            'description' => 'El usuario puede editar la info de un rol.',
        ]);

        //permission specialty
        // 28
        $permission = Permission::create([
            'name' => 'Listar Especialidades',
            'slug' => 'specialty.index',
            'description' => 'El usuario puede listar las especialidades.',
        ]);

        // 29
        $permission = Permission::create([
            'name' => 'Ver Especialidades',
            'slug' => 'specialty.show',
            'description' => 'El usuario puede ver la info de las especialidades.',
        ]);

        // 30
        $permission = Permission::create([
            'name' => 'Crear Especialidad',
            'slug' => 'specialty.create',
            'description' => 'El usuario puede crear una especialidad.',
        ]);

        // 31
        $permission = Permission::create([
            'name' => 'Editar Especialidad',
            'slug' => 'specialty.edit',
            'description' => 'El usuario puede editar la info de una especialidad.',
        ]);

        //permission banned user
        // 32
        $permission = Permission::create([
            'name' => 'Activar Usuario',
            'slug' => 'user.state',
            'description' => 'El usuario puede activar la cuenta de una persona.',
        ]);

        //permission active user
        // 33
        $permission = Permission::create([
            'name' => 'Banear Usuario',
            'slug' => 'user.state',
            'description' => 'El usuario puede banear la cuenta de una persona.',
        ]);

        //permission appointment
        // 35
        /* $permission = Permission::create([
        'name' => 'Crear Cita Médica',
        'slug' => 'appointmentmedical.create',
        'description' => 'El usuario puede crear una cita médica.',
        ]); */

        // Agregado
        //permission dashboard administrator
        // 34
        $permission = Permission::create([
            'name' => 'Dashboard Administrador',
            'slug' => 'administrator.dashboard',
            'description' => 'El usuario puede ver un resumen de su actividad como administrador.',
        ]);

        // Agregado
        //permission dashboard doctor
        // 35
        $permission = Permission::create([
            'name' => 'Dashboard Médico',
            'slug' => 'doctor.dashboard',
            'description' => 'El usuario puede ver un resumen de su actividad como médico.',
        ]);

        // Agregado
        // 36
        $permission = Permission::create([
            'name' => 'Dashboard Paciente',
            'slug' => 'patient.dashboard',
            'description' => 'El usuario puede ver un resumen de su actividad como paciente.',
        ]);
    }
}
