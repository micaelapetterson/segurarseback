<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\GestorEmpleado;
use App\Models\Puesto;
use App\Models\RegistroSalario;

use App\Http\Requests\EmpleadoRequest;
use App\Http\Requests\IncrementarSalarioRequest;
use Illuminate\Validation\Rule;


class GestorEmpleadoController extends Controller
{

    private $gestorEmpleado;

    public function __construct(GestorEmpleado $gestorEmpleado)
    {
        $this->gestorEmpleado = $gestorEmpleado;
    }

    public function agregarEmpleado(EmpleadoRequest $request)
    {
        try {

            $empleado = $this->gestorEmpleado->agregarEmpleado($request->all());

            Log::info('Se agregó un nuevo empleado: ' . $empleado->id . ': ' . $empleado->obtenerNombre() );

            return response()->json(['message' => 'Empleado agregado correctamente', 'data' => $empleado]);
        
        } catch (\Exception $e) {

            Log::error('Error al agregar empleado: ' . $request->apellido . '. ' . $e->getMessage() );

            return response()->json(['error' => 'Error al agregar empleado'], 500);
        }
    }


    public function salarioPromedio()
    {
        $salarioPromedio = $this->gestorEmpleado->calcularSalarioPromedio();

        return response()->json(['salario_promedio' => $salarioPromedio]);
    }


    public function incrementarSalariosAll(Request $request)
    {
        try{ 

            $porcentaje = $request->porcentaje;

            $empleados = $this->gestorEmpleado->getTodosEmpleados();
            
            $resultados = $this->gestorEmpleado->incrementarSalarios($empleados, $porcentaje);

            return $resultados;

        }catch (\Exception $e) {

            Log::error('Error al incrementar salarios: ' . $e->getMessage());
            
            return response()->json(['error' => 'Error al incrementar salarios'], 500);
        }
        
    }


    public function incrementarSalarios(IncrementarSalarioRequest $request)
    {
        try {
            $this->gestorEmpleado->incrementarSalarios($request->empleados, $request->porcentaje);

            Log::info('Se incrementaron los salarios correctamente' );

            return response()->json(['message' => 'Salarios incrementados correctamente']);

        } catch (\Exception $e) {

            Log::error('Error al incrementar salario: ' . $e->getMessage());

            return response()->json(['error' => 'Error al incrementar salario'], 500);
        }
    }


    public function visualizarSalarios()
    {
        try {
            $salarios = $this->gestorEmpleado->visualizarSalarios();

            return response()->json(['salarios' => $salarios]);
        
        } catch (\Exception $e) {
        
            Log::error('Error al visualizar salarios: ' . $e->getMessage());

            return response()->json(['error' => 'Error al visualizar salarios'], 500);
        }
    }

}
