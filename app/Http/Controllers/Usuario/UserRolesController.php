<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\RoleUser;
use App\Http\Requests\UserRoleCreate;

class UserRolesController extends Controller
{
    private $id_user;

    public function index($id){

        $this->id_user = $id;

        $user = User::find($id);

        $funcoes_vinculadas = $user->roles;

        $funcoes = Role::all();

        $funcoes_nao_vinculadas = $funcoes->diff($funcoes_vinculadas);

        return view('usuarios.userRoles', compact('user','funcoes_vinculadas','funcoes_nao_vinculadas'));
    }

    public function vincular(UserRoleCreate $request, $id_usuario){

        $role_id = $request->role_id;

        $roleUser = new RoleUser;

        if( $gate->denies('manager',$roleUser) )
            abort(403,'Não Autoriazado');

        $roleUser->role_id = $role_id;
        
        $roleUser->user_id = $id_usuario;
          
        if(  $roleUser->save()){
            return back()->with('status','Função vinculada com sucesso!');
        }
        else{
            return back()->with('error','A Função não pôde ser vinculada! Tente novamente!');
        }
    }

    public function delete($id, $id_usuario){

        if( $gate->denies('manager',$id_usuario) )
            abort(403,'Não Autoriazado');

        $role = RoleUser::where('role_id',$id)->where('user_id',$id_usuario)->delete();
        

        if($role){
            return back()->with('status','Função desvinculada com sucesso.');
        }
        else{
            return back()->with('error','Erro ao desvincular Função! Tente novamente.');
        }
    }
}