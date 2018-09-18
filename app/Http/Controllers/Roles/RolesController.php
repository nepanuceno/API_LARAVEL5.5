<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class RolesController extends Controller
{
    
    public function list(){
        $roles = Role::all();

        return view('acl.roles.listRoles', compact('roles'));
    }

    public function form(){

        return view('acl.roles.addRoles');
    }

    public function add(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|max:50|min:3',
            'label' => 'required',
        ]);
    
        $role = new Role;
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
       
        if($role){
            return redirect('listRoles')->with('status', 'Função removida com sucesso!');
        }
        else{
            return redirect('listRoles')->with('error', 'Erro ao remover Função!');
        }
    }
}