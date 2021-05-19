<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{


    /**
     * UserController constructor.
     */
   /* public function __construct()
    {
        $this->middleware('jwtauth')->except('authenticate');
    }*/

    public function index(){
        try{
            $listuser = User::all();
            return \response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $listuser
            ]);
        }catch (\Exception $exception){
            return \response()->json([
                'status' => false,
                'message' => 'errro'
            ]);
        }
    }
    //
    public function authenticate(Request $request)
    {
        $credential = $request->json()->all();
        $validator = Validator::make($credential, [
            'email' => 'required',
            'password' => 'required'

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

    public function register(Request $request)
    {


        return response()->json([
            'message' => ' you can continue'
        ]);
    }

    public function update(Request $request)
    {
        return response()->json([
            'message' => ' you can continue'
        ]);
    }

    public function delete(Request $request)
    {
        return response()->json([
            'message' => ' you can continue'
        ]);
    }
}
