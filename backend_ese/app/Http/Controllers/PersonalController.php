<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $objCliente = new Personal();
            $objCliente->fill($request->json()->all());
            $objCliente->save();

            return response()->json([
                "res" => "success",
                "data" => $objCliente
            ]);

        } catch (Exception $e) {
            return response()->json([
                "res" => "error",
                "data" => $e
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show(Personal $personal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit(Personal $personal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personal $personal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personal $personal)
    {
        //
    }

    public function  login(Request $request){
        $credential = $request->json()->all();
        $validator = Validator::make($credential, [
            'email' => 'required',

        ]);
        if (!$validator->fails()) {
            try {
                if (!$token = JWTAuth::attempt($credential)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid credentials'
                    ]);
                }
            } catch (JWTException $exception) {
                return response()->json([
                    'status' => false,
                    'error' => $exception->getMessage(),
                    'message' => 'Invalid credentials'
                ]);

            }

            return response()->json([
                'status' => true,
                'token' => compact('token'),
                'message' => 'Valid credentials'
            ]);
        } else {
            return response()->json([
                "res" => "error",
                "data" => $validator->messages()
            ]);
        }
    }
}
