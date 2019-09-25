<?php

use App\Empleado;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    public function run()
    {
        $data = new Empleado();
        $data->dpi = '1234567898765';
        $data->nit = '123456';
        $data->nombre1 = 'Mimi';
        $data->apellido1 = 'Ramos';
        $data->nacimiento = '1994-06-15';
        $data->email = 'admin@admin.com';
        $data->estado_civil_id= 1;
        $data->municipio_id = 1;
        $data->direccion = 'Avenida principal';
        $data->genero = 'F';
        $data->profesion = 'Perito en administración de empresas';
        $data->save();
    }
}
