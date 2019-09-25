<?php

use App\EstadoCivil;
use Illuminate\Database\Seeder;

class EstadoCivilSeeder extends Seeder
{
    public function run()
    {
        $data = new EstadoCivil();
        $data->nombre = 'Soltero';
        $data->save();
    }
}
