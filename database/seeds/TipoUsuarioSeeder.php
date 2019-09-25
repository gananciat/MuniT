<?php

use App\TipoUsuario;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    public function run()
    {
        $data = new TipoUsuario();
        $data->nombre = 'admin';
        $data->save();
    }
}
