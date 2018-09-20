<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Contracts\Auth\Access\Gate;

class RolesController extends Controller
{
    public function __construct(Gate $gate, Role $role)
    {
        $this->gate = $gate;
        $this->role = $role;
    }
    public function list(){
        $roles = $this->role->all();

        if( $this->gate->denies('administrador',$roles) )
            abort(403,'Não Autoriazado');

        return view('acl.roles.listRoles', compact('roles'));
    }

    public function form(){

        if( $this->gate->denies('administrador',$roles) )
            abort(403,'Não Autoriazado');


        return view('acl.roles.addRoles');
    }

    public function add(Request $request, Gate $gate){
        
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|max:50|min:3',
            'label' => 'required',
        ]);
    
        $role = new Role;

        if( $this->gate->denies('administrador',$role) )
            abort(403,'Não Autoriazado');

        $role->name = $request->name;
        $role->label = $request->label;
       

        if( $role->save()){
            return redirect('listRoles')->with('status', 'Função cadastrada com sucesso!');
        }
        else{
            return redirect('listRoles')->with('error', 'Erro ao tentar cadastrar Função!');
        }
    }

    public function delete($id){
        $role = Role::destroy($id);

        if( $this->gate->denies('administrador',$role) )
            abort(403,'Não Autoriazado');
       
        if($role){
            return redirect('listRoles')->with('status', 'Função removida com sucesso!');
        }
        else{
            return redirect('listRoles')->with('error', 'Erro ao remover Função!');
        }
    }
}