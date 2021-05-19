<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EstadoProceso;
use App\Models\Estadosubproceso;
use App\Models\SubProceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstadosubprocesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        try {
            $listestadosubProceso = Estadosubproceso::all();
            return \response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $listestadosubProceso
            ], 200);
        } catch (\Exception $exception) {
            return \response()->json([
                'status' => false,
                'message' => 'errro'
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->json()->all(), [
            'nombre' => 'required',
            'hora_estimada' => 'required',
            'estado' => 'required',
            'procesos_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "data" => $validator->messages()
            ]);
        }
        try {
            $objestadosubProceso = new Estadosubproceso();
            $objestadosubProceso->fill($request->json()->all());
            $objestadosubProceso->save();
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $objestadosubProceso
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => 'error',
                'data' => []
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Empresa $empresa
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        try {
            $objestadosubProceso = Estadosubproceso::find($id);
            if ($objestadosubProceso == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'error',
                    'data' => []
                ], 500);
            }
            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $objestadosubProceso
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => false,
                "message" => "error",
                "data" => []
            ], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Empresa $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Empresa $empresa
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $objestadosubProceso = Estadosubproceso::find($id);
            if ($objestadosubProceso == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "no se encuentra la estado Proceso"
                ], 500);
            }
            $objestadosubProceso->fill($request->json()->all());
            $objestadosubProceso->save();

            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $objestadosubProceso
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "error",
                "data" => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Empresa $empresa
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        try {
            $objestadosubProceso = Estadosubproceso::find($id);
            if ($objestadosubProceso == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "Objeto no encontrado"
                ], 400);
            }
            $objestadosubProceso->delete();
            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => "Objeto Eliminado"
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                "res" => "error",
                "data" => "Error al eliminar Empresa"
            ], 500);
        }
    }
}
