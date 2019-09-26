<?php

use App\Unidad;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            $insert = new Unidad();
            $insert->nombre = 'Unidad '.$i;
            $insert->save();
        }
    }
}
