<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsuariosController extends Controller
{
    public function listar(){
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function editar($id){
        $usuario = User::find($id);

       // dd($usuario);

        return view('auth.edit', compact('usuario'));
    }

    public function update(Request $request){

        $usuario = User::find($request->input('id'));

        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');

        $usuario->save();

        return redirect('/listaUsuarios')->with('status', 'Usuário Atualizado!');
    }

    public function updateStatus($id){

        $usuario = User::find($id);

        if($usuario->status === null){
            $usuario->status = 1;
            $usuario->save();

            return redirect('/listaUsuarios')->with('status', 'Usuário Ativado com sucesso!');
        }
        else{
            $usuario->status = null;
            $usuario->save();

            return redirect('/listaUsuarios')->with('status', 'Usuário desativado com sucesso!');
        }

    }
}