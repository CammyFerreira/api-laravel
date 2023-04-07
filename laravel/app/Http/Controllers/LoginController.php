<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' => 'required|string',
            'senha' => 'required|string'
        ]);
    
        $user = User::where('USUARIO_EMAIL', $request->email)->first();
    
        if (!$user || $request->senha !== $user->USUARIO_SENHA) {
            return response([
                'message' => 'Credenciais inválidas'
            ], 401);
        }
    
    
        return response([
            'message' => 'Login realizado com sucesso!'
        ], 200);
    }
    
    //TODO - Usar essa verificação quando fizer o cadastro || !Hash::check($request->senha, $user->USUARIO_SENHA)
    
}