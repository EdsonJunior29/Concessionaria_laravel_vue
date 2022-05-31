<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //Autenticação (email e senha)
        $credenciais = $request->all(['email', 'password']);
        $token = auth('api')->attempt($credenciais);

        //retorna um JWT(Json Web Token)
        if (!$token) {
            //Usuário não autenticado.
            //$token retornou false.
            return response()->json(['errors' => 'Email ou Senha inválidos!'], 403);
        }

        return response()->json(['token' => $token], 200);
    }

    public function logout()
    {
        return 'logout....';
    }

    public function refresh()
    {
        //Necessário o client(FrontEnd) encaminhar um JWT válido.
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
