<?php

namespace Models\Security;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $dbFields = [
        'id' => [ 'int' ],
        'name' => [ 'text' ],
        'slug' => [ 'text' ],
        'description' => [ 'text' ],
    ];
}