<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(Request $request){

        $this->validate($request, [
            'USUARIO_NOME' => 'required|min:4',
            'USUARIO_EMAIL' => 'required|email',
            'USUARIO_SENHA' => 'required|min:8',
            'USUARIO_CPF' => 'required|min:11',
        ]);

        $user = User::create([
            'USUARIO_NOME' => $request->USUARIO_NOME,
            'USUARIO_EMAIL' => $request->USUARIO_EMAIL,
            'USUARIO_SENHA' => bcrypt($request->USUARIO_SENHA),
            'USUARIO_CPF' => $request->USUARIO_CPF,
        ]);

        if (!$user) {
            return response()->json(['error' => 'Falha ao cadastrar o usuário.'], 500);
       }
        return response()->json(['message' => "Usuário cadastrado com sucesso!"], 200);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string',
            'senha' => 'required|string'
        ]);
    
        $user = User::where('USUARIO_EMAIL', $request->email)->first();
    
        if (!$user || !Hash::check($request->senha, $user->USUARIO_SENHA)) {
            return response([
                'message' => 'Credenciais inválidas'
            ], 401);
        }
    
        return response([
            'user_id' => $user->USUARIO_ID,
            'message' => 'Login realizado com sucesso!'
        ], 200);
    }

    public function logout(Request $request){
        $accessToken = auth()->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();

        return response([
            'message' => 'You have been sucessfully logged out',
        ], 200);
    }

    public function userInfo() {
        $user = auth()->user();

        return response()->json(['user' => $user], 200);
    }
    
}