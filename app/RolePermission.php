<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'permission_role';

    protected $fillable = [
        'permission_id'
    ];
}
