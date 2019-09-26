<?php

use App\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    public function run()
    {
        $insert = new Cargo();
        $insert->nombre = 'Cargo 1';
        $insert->save();

        $insert = new Cargo();
        $insert->nombre = 'Cargo 2';
        $insert->save();        
    }
}
