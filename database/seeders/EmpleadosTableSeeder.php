<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Empleado;
use App\Models\RegistroSalario;


use DB;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $empleado = new Empleado();
        $empleado->nombre = "Juan";
        $empleado->apellido = "Perez";
        $empleado->antiguedad = 10;
        $empleado->salario = 100000;
        $empleado->puesto_id = 1;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 100000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Carlos";
        $empleado->apellido = "Sanchez";
        $empleado->antiguedad = 20;
        $empleado->salario = 150000;
        $empleado->puesto_id = 2;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 150000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Federico";
        $empleado->apellido = "Alvarez";
        $empleado->antiguedad = 30;
        $empleado->salario = 160000;
        $empleado->puesto_id = 1;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 160000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Matias";
        $empleado->apellido = "Martinez";
        $empleado->antiguedad = 1;
        $empleado->salario = 170000;
        $empleado->puesto_id = 2;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 170000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Santiago";
        $empleado->apellido = "Rodriguez";
        $empleado->antiguedad = 2;
        $empleado->salario = 180000;
        $empleado->puesto_id = 1;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 180000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Maria";
        $empleado->apellido = "Sanchez";
        $empleado->antiguedad = 3;
        $empleado->salario = 190000;
        $empleado->puesto_id = 2;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 190000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Marta";
        $empleado->apellido = "Benitez";
        $empleado->antiguedad = 4;
        $empleado->salario = 200000;
        $empleado->puesto_id = 1;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 200000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Norma";
        $empleado->apellido = "Caseres";
        $empleado->antiguedad = 5;
        $empleado->salario = 210000;
        $empleado->puesto_id = 2;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 210000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Juana";
        $empleado->apellido = "Dominguez";
        $empleado->antiguedad = 6;
        $empleado->salario = 220000;
        $empleado->puesto_id = 2;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 220000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Estela";
        $empleado->apellido = "Lopez";
        $empleado->antiguedad = 1;
        $empleado->salario = 230000;
        $empleado->puesto_id = 1;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 230000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);

        $empleado = new Empleado();
        $empleado->nombre = "Mirta";
        $empleado->apellido = "Estevez";
        $empleado->antiguedad = 1;
        $empleado->salario = 240000;
        $empleado->puesto_id = 1;
        $empleado->save();

        $empleado->registroSalarios()->create([
            'salarioHistorico' => 240000,
            'fechaSalario' => now(),
            'tipo' => 'nuevo',
        ]);
        
    }
}
