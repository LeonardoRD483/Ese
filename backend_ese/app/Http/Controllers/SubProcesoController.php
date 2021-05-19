<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Proceso;
use App\Models\SubProceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubProcesoController extends Controller
{
    public function index()
    {
        //
        try {
            $listsubProceso = SubProceso::all();
            return \response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $listsubProceso
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
            $objsubproceso = new SubProceso();
            $objsubproceso->fill($request->json()->all());
            $objsubproceso->save();
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $objsubproceso
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
            $objsubProceso = SubProceso::find($id);
            if ($objsubProceso == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'error',
                    'data' => []
                ], 500);
            }
            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $objsubProceso
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
            $objsubProceso = SubProceso::find($id);
            if ($objsubProceso == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "no se encuentra la empresa"
                ], 500);
            }
            $objsubProceso->fill($request->json()->all());
            $objsubProceso->save();

            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $objsubProceso
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
            $objsubproceso = SubProceso::find($id);
            if ($objsubproceso == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "Objeto no encontrado"
                ], 400);
            }
            $objsubproceso->delete();
            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => "Objeto Eliminado"
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                "res" => "error",
                "data" => "Error al eliminar sub_proceso"
            ], 500);
        }
    }
}
