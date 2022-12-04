<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialty::create([
            'name' => 'Medico Familiar',
            'description' => 'Brinda atención médica continua e integral para el individuo y la familia.',
        ]);

        Specialty::create([
            'name' => 'Nutricionista',
            'description' => 'Brinda atención en el ámbito alimenticio.',
        ]);

        Specialty::create([
            'name' => 'Odontólogo',
            'description' => 'Brinda atención en el área odontologíco',
        ]);
    }
}
