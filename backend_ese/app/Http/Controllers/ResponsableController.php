<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResponsableController extends Controller
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
            $listResposanble = Responsable::all();
            return \response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $listResposanble
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
            'email' => 'required',
            'numero' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "res" => "error",
                "data" => $validator->messages()
            ]);
        }
        try {
            $objResponsable = new Responsable();
            $objResponsable->fill($request->json()->all());
            $objResponsable->save();
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $objResponsable
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
            $objResponsable = Responsable::find($id);
            if ($objResponsable == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'error',
                    'data' => []
                ], 500);
            }
            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $objResponsable
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
            $objResponsable = Responsable::find($id);
            if ($objResponsable == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "no se encuentra la Responsable"
                ], 500);
            }
            $objResponsable->fill($request->json()->all());
            $objResponsable->save();

            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $objResponsable
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
            $objResponsable = Responsable::find($id);
            if ($objResponsable == null) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => "Objeto no encontrado"
                ], 400);
            }
            $objResponsable->delete();
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
