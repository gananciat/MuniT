<?php

use App\Dia;
use Illuminate\Database\Seeder;

class DiaLaboralSeeder extends Seeder
{
    /**
     * Run the database seeds. dia laboral seeder
     */
    public function run()
    {
        $data = new Dia();
        $data->nombre = 'Lunes';
        $data->abreviatura = "Lun";
        $data->save();

        $data = new Dia();
        $data->nombre = 'Martes';
        $data->abreviatura = "Mar";
        $data->save();

        $data = new Dia();
        $data->nombre = 'Miercoles';
        $data->abreviatura = "Mie";
        $data->save();

        $data = new Dia();
        $data->nombre = 'Jueves';
        $data->abreviatura = "Jue";
        $data->save();

        $data = new Dia();
        $data->nombre = 'Viernes';
        $data->abreviatura = "Vie";
        $data->save();

        $data = new Dia();
        $data->nombre = 'Sabado';
        $data->abreviatura = "Sab";
        $data->save();
    }
}
