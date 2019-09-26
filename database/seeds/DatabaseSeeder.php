<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(DepartamentoSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(EstadoCivilSeeder::class);
        $this->call(TipoUsuarioSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DiaLaboralSeeder::class);

        $this->call(CargoSeeder::class);
        $this->call(UnidadSeeder::class);
    }
}
