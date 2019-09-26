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
        $data->estado = 0;
        $data->save();

        $data = new Empleado();
        $data->dpi = '1234567898766';
        $data->nit = '123457';
        $data->nombre1 = 'Fercho';
        $data->apellido1 = 'Ramos';
        $data->nacimiento = '1994-06-15';
        $data->email = 'admin1@admin.com';
        $data->estado_civil_id= 1;
        $data->municipio_id = 2;
        $data->direccion = 'Avenida principal';
        $data->genero = 'M';
        $data->profesion = 'Perito en administración de empresas';
        $data->estado = 0;        
        $data->save();     

        $data = new Empleado();
        $data->dpi = '1234567898723';
        $data->nit = '1223537';
        $data->nombre1 = 'Julieta';
        $data->apellido1 = 'Ramos';
        $data->nacimiento = '1994-06-15';
        $data->email = 'admin31@admin.com';
        $data->estado_civil_id= 1;
        $data->municipio_id = 19;
        $data->direccion = 'Avenida principal';
        $data->genero = 'F';
        $data->profesion = 'Perito en administración de empresas';
        $data->estado = 0;        
        $data->save();     

        $data = new Empleado();
        $data->dpi = '1234567812723';
        $data->nit = '122357';
        $data->nombre1 = 'Juan';
        $data->apellido1 = 'Ramos';
        $data->nacimiento = '1994-06-15';
        $data->email = 'admin2@admin.com';
        $data->estado_civil_id= 1;
        $data->municipio_id = 10;
        $data->direccion = 'Avenida principal';
        $data->genero = 'M';
        $data->profesion = 'Perito en administración de empresas';
        $data->estado = 0;       
        $data->save();     
    }
}
