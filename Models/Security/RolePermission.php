<?php

namespace Models\Security;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'role_permissions';

    protected $primaryKey = 'role_id';

    protected $guarded = [];
    
    protected $dbFields = [
        'role_id' => ['int'],
        'permission_id' => ['int'],
    ];
}