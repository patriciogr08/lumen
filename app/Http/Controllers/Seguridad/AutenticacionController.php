<?php
namespace App\Http\Controllers\Seguridad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\User;
use App\Http\Controllers\Controller;

class AutenticacionController extends Controller{

    
    public function login(Request $request)
    {
        
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);
        $jwt_token = null;
        if (!$token = Auth::attempt($credentials)) {
            return  response()->json([
                'status' => 'invalid_credentials',
                'message' => 'Correo o contraseña no válidos.',
            ], 401);
        }
        $token_generado = $this->respondWithToken($token);
        return $token_generado;/*
        return  response()->json([
            'status' => 'ok',
            'token' => $jwt_token,
        ]);*/
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
    public function payload()
    {
        return response()->json(auth()->payload());
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        /*auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
        */
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);
            return  response()->json([
                'status' => 'ok',
                'message' => 'Cierre de sesión exitoso.'
            ]);
        } catch (JWTException  $exception) {
            return  response()->json([
                'status' => 'unknown_error',
                'message' => 'Al usuario no se le pudo cerrar la sesión.'
            ], 500);
        }

    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    
}