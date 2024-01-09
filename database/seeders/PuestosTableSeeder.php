<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class PuestosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('puestos')->insert([
            ['id' => 1, 'descripcion' => 'Vendedor'],
            ['id' => 2, 'descripcion' => 'Atención al cliente'],
            ['id' => 3, 'descripcion' => 'Gerente']
        ]);
    }
}
