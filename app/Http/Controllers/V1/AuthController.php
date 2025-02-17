<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    public function register(Request $request){
        $validations = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];

        $request->validate($validations);

        $data = $request->only('name', 'email', 'password');

        $user = User::create($data);

        $credentials = $request->only('email', 'password');

        return response()->json([
            'message' => 'Usuario registrado',
            'token' => JWTAuth::attempt($credentials),
            'user' => $user
        ]);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');


        // Validamos las credenciales
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Error en las credenciales'], 401);
        }

        // Obtenemos el usuario autenticado
        $user = JWTAuth::user();

        // Devolvemos la respuesta con el token y la información del usuario
        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function unlog(Request $request){
        $token = JWTAuth::getToken();


        try {
            JWTAuth::invalidate($token);
            return response()->json([
                'message' => 'Sesión cerrada exitosamente'
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                'error' => 'No se pudo cerrar la sesión',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getUser(Request $request){
        $token = JWTAuth::getToken();

        try {
            $user = JWTAuth::authenticate($token);

            return response()->json($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token invalido'], 401);
        }

    }
}
