<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $hidden = [
        'object_id', 'object_type'
    ];

    protected $dbFields = [
        'id' => ['int'],
        'object_id' => [ 'int' ],
        'object_type' => [ 'text' ],
        'path' => [ 'text' ],
        'type' => [ 'text' ],
        'created_at' => [ 'datetime' ],
        'updated_at' => [ 'datetime' ],
    ];
}