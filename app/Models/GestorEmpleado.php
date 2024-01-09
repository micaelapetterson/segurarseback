<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;

use DB;

class GestorEmpleado
{

    public function getTodosEmpleados()
    {
        return Empleado::get();
    }

    public function agregarEmpleado($datos)
    {
        DB::beginTransaction();

        try {

            $empleado = Empleado::create($datos);

            // Registrar el salario para llevar un histíorico
            $empleado->registroSalarios()->create([
                'salarioHistorico' => $empleado['salario'],
                'fechaSalario' => now(),
                'tipo' => "nuevo",
            ]);

            DB::commit();

            return $empleado;

        } catch (\Exception $e) {

            DB::rollBack();

        }
        
    }


    public function calcularSalarioPromedio()
    {
        return Empleado::average('salario');
    }

    
    public function incrementarSalarios($request, $porcentaje)
    {
        DB::beginTransaction();

        try {
            $empleados = Empleado::all();

            foreach ($empleados as $empleado) {
                $nuevoSalario = $empleado->salario * (1 + ($porcentaje / 100));
                $empleado->update(['salario' => $nuevoSalario]);
        
                // Registrar salario histórico
                $empleado->registroSalarios()->create([
                    'salarioHistorico' => $nuevoSalario,
                    'fechaSalario' => now(),
                    'tipo' => "incremento",
                ]);
            }

            DB::commit();

            Log::info('Se incrementaron los salarios' . $porcentaje . "%");

            return response()->json(["message" => "Se incrementaron los salarios"], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error al intentar incrementar los salarios: ' . $porcentaje . "%. " . $e->getMessage() . $empleado->obtenerNombre());

            return response()->json(["message" => "Error al incrementar los salarios", "error" => $e->getMessage()], 500);
        }

        return $empleados;
    }


    public function visualizarSalarios()
    {

        $salarios = Empleado::with('registroSalarios')->get();

        return $salarios;
    }

}

