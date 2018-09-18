<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate;

class UsuariosController extends Controller
{
    public function listar(Gate $gate){
        $usuarios = User::all();
        if( $gate->denies('manager',$usuarios) )
            abort(403,'Não Autoriazado');
        
        return view('usuarios.index', compact('usuarios'));
    }

    public function editar($id, Gate $gate){
        $usuario = User::find($id);

        if( $gate->denies('manager',$usuario) )
            abort(403,'Não Autoriazado');
        return view('auth.edit', compact('usuario'));
    }

    public function update(Request $request, Gate $gate){

        $usuario = User::find($request->input('id'));

        if( $gate->denies('manager',$usuario) )
            abort(403,'Não Autoriazado');

        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');

        $usuario->save();

        return redirect('/listaUsuarios')->with('status', 'Usuário Atualizado!');
    }

    public function updateStatus($id, Gate $gate){

        $usuario = User::find($id);

        if( $gate->denies('manager',$usuario) )
            abort(403,'Não Autoriazado');

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