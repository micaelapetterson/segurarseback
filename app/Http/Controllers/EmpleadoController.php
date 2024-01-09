<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\RegistroSalario;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\EmpleadoRequest;

use DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::get();

        return response()->json($empleados, 200);
    }


    /**
     * Display a listing of the resource with pagination
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $puesto = $request->input('puesto', '');
        $signo = $request->input('signo', '');
        $antiguedad = $request->input('antiguedad', '');

        $query = Empleado::orderBy('id')
                        ->with("puesto")
                        ->with("registroSalarios");

        if ($puesto) {
            $query->where('puesto_id', $puesto);
        }

        if ($antiguedad) {
            $query->where('antiguedad', $signo , $antiguedad);
        }

        $limit = $request->input('limit', '');
        
        $empleados = ($limit != -1) ? $query->paginate($limit) : $query->paginate(9999999999);

        return response()->json($empleados, 200);

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {
        DB::beginTransaction();

        try {

            $puesto = Puesto::findOrFail($request->puesto_id);

            $empleado = new Empleado();
            $empleado->nombre = $request->nombre;
            $empleado->apellido = $request->apellido;
            $empleado->antiguedad = $request->antiguedad;
            $empleado->salario = $request->salario;
            $empleado->puesto()->associate($puesto);
            $empleado->save();

            // Registrar el salario para llevar un histíorico
            $empleado->registroSalarios()->create([
                'salarioHistorico' => $empleado['salario'],
                'fechaSalario' => now(),
                'tipo' => "nuevo",
            ]);

            DB::commit();

            Log::info('Se agregó un nuevo empleado: ' . $empleado->id . ': ' . $empleado->obtenerNombre());

            return response()->json(["message" => "Empleado registrado"], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error al agregar empleado: ' . $e->getMessage() . $empleado->obtenerNombre());

            return response()->json(["message" => "Error al guardar el Registro", "error" => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::with("puesto")
                    ->findOrFail($id);
        return response()->json($empleado, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $puesto = Puesto::findOrFail($request->puesto_id);

            $empleado = Empleado::findOrFail($id);

            $salarioAnterior = $empleado->salario;

            $empleado->nombre = $request->nombre;
            $empleado->apellido = $request->apellido;
            $empleado->antiguedad = $request->antiguedad;
            $empleado->salario = $request->salario;
            $empleado->puesto()->associate($puesto);
            $empleado->update();

            // Si el salario cambió, registrarlo
            if( $salarioAnterior != $request->salario){
                $empleado->registroSalarios()->create([
                    'salarioHistorico' => $request->salario,
                    'fechaSalario' => now(),
                    'tipo' => "actualizacion"
                ]);    
            }    

            DB::commit();

            Log::info('Se actualizaron datos de empleado: ' . $empleado->id . ': ' . $empleado->obtenerNombre());

            return response()->json(["message" => "Registro actualizado"], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error al actualizar empleado: ' . $e->getMessage() . $empleado->obtenerNombre());

            return response()->json(["message" => "Error al guardar el Registro", "error" => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->registroSalarios()->delete();
            $empleado->delete();

            return response()->json(["message" => "Empleado eliminado"], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            Log::error('Error al eliminar empleado: ' . $e->getMessage() . $id . ' ' . $empleado->obtenerNombre() );

            return response()->json(["message" => "Error al eliminar el registro. El empledo no fue encontrado."], 404);
        } catch (\Exception $e) {
            
            Log::error('Error al agregar empleado: ' . $e->getMessage() . $id . ' ' . $empleado->obtenerNombre() );

            return response()->json(["message" => "Error al eliminar el registro", "error" => $e->getMessage()], 500);
        }
    }
}
