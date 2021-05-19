<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class ProyectoController extends Controller
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
            $list = Proyecto::all();
            return \response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $list
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
            'codigo_referencia' => 'required',
            'nombre' => 'required',
            'fecha_inicio' => 'required',
            'fecha_estimada' => 'required',
            'estado' => 'required',
            'monton' => 'required',
            'ubicación' => 'required',
            'users_id' => 'required',
            'empresas_id' => 'required',
            'estructura_procesos_id' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "data" => $validator->messages()
            ]);
        }
        try {
            $obj= new Proyecto();
            $obj->fill($request->json()->all());
            $obj->save();
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $obj
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
            $obj = Proyecto::find($id);
            if ($obj == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'error',
                    'data' => []
                ], 500);
            }
            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $obj
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
            $obj = Proyecto::find($id);
            if ($obj == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "no se encuentra el proyecto"
                ], 500);
            }
            $obj->fill($request->json()->all());
            $obj->save();

            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $obj
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
            $obj = Proyecto::find($id);
            if ($obj == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "Objeto no encontrado"
                ], 400);
            }
            $obj->delete();
            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => "Objeto Eliminado"
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                "res" => "error",
                "data" => "Error al eliminar el proyecto"
            ], 500);
        }
    }

    public function usersProyect(){
        DB::select('SELECT id FROM users WHERE proyecto = ?', ['Desarrollador back-end']);
    }
}
