<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EstadoProceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstadoProcesoController extends Controller
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
            $listestadoProceso = EstadoProceso::all();
            return \response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $listestadoProceso
            ], 200);
        } catch (\Exception $exception) {
            return \response()->json([
                'status' => false,
                'message' => 'error'
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
            'estado' => 'required',
            'fecha' => 'required',
            'procesos_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "data" => $validator->messages()
            ]);
        }
        try {
            $objestadoProceso = new EstadoProceso();
            $objestadoProceso->fill($request->json()->all());
            $objestadoProceso->save();
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $objestadoProceso
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
            $objestadoProceso = EstadoProceso::find($id);
            if ($objestadoProceso == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'error',
                    'data' => []
                ], 500);
            }
            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $objestadoProceso
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
            $objestadoProceso = EstadoProceso::find($id);
            if ($objestadoProceso == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "no se encuentra la estado Proceso"
                ], 500);
            }
            $objestadoProceso->fill($request->json()->all());
            $objestadoProceso->save();

            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $objestadoProceso
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
            $objestadoProceso = EstadoProceso::find($id);
            if ($objestadoProceso == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "Objeto no encontrado"
                ], 400);
            }
            $objestadoProceso->delete();
            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => "Objeto Eliminado"
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                "res" => "error",
                "data" => "Error al eliminar objeto"
            ], 500);
        }
    }
}
