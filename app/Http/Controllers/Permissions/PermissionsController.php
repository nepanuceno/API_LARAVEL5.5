<?php

namespace App\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use App\Http\Requests\RequestPermission;
use App\Http\Controllers\Controller;
use App\Permission;
class PermissionsController extends Controller
{
    
    public function list(){
        $permissions = Permission::all();

        return view('acl.permissions.listPermissions', compact('permissions'));
    }

    public function form(){

        return view('acl.permissions.addPermission');
    }

    public function add(RequestPermission $request){
        
        // $validatedData = $request->validate([
        //     'name' => 'required|unique:roles|max:50|min:3',
        //     'label' => 'required',
        // ]);
    
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->label = $request->label;

        if( $permission->save()){
            return redirect('listPermissions')->with('status', 'Permissão cadastrada com sucesso!');
        }
        else{
            return redirect('listPermissions')->with('error', 'Erro ao tentar cadastrar Permissão!');
        }
    }

    public function delete($id){
        $permission = Permission::destroy($id);
       
        if($permission){
            return redirect('listPermissions')->with('status', 'Permissão removida com sucesso!');
        }
        else{
            return redirect('listPermissions')->with('error', 'Erro ao remover Permissão!');
        }
    }
}
