<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";

    protected $primaryKey = 'id';

    protected $guarded = [];
}