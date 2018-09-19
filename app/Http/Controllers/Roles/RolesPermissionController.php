<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use App\RolePermission;
use App\Http\Requests\RolePermissionsCreate;
use Illuminate\Contracts\Auth\Access\Gate;

class RolesPermissionController extends Controller
{
    protected $gate;
    
    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
    }
    public function index($id_role){
       
        $role = Role::find($id_role);

        if( $this->gate->denies('manager',$role) )
            abort(403,'Não Autoriazado');

        $permissions = Permission::all();

        $permissions_vinculadas = $role->permissions;

        $permissions_liberadas = $permissions->diff($permissions_vinculadas);

        return view('acl.roles.rolePermissions', compact('role','permissions_vinculadas','permissions_liberadas'));
    }

    public function vincular(RolePermissionsCreate $request, $id_role)
    {
        $rolePermission = new RolePermission;
        
        if( $this->gate->denies('manager',$rolePermission) )
            abort(403,'Não Autoriazado');

        $rolePermission->permission_id = $request->permission_id;
        $rolePermission->role_id = $id_role;

        if(  $rolePermission->save()){
            return back()->with('status','Permissão vinculada com sucesso!');
        }
        else{
            return back()->with('error','A permissão não pôde ser vinculada! Tente novamente!');
        }

    }

    public function delete($id, $role_id){

       
        $permission = new RolePermission;

        
        if( $this->gate->denies('manager',$permission) )
            abort(403,'Não Autoriazado');

        $permission->where('permission_id',$id)->where('role_id',$role_id)->delete();

    
        if($permission){
            return back()->with('status','Permissão desvinculada com sucesso.');
        }
        else{
            return back()->with('error','Erro ao desvincular Permissão! Tente novamente.');
        }
    }
}
