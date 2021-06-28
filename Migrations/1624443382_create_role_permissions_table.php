<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateRolePermissionsTable
{
    private $name = 'role_permissions';

    public function up()
    {
        Capsule::schema()->create($this->name, function(Blueprint $table) {
            $table->id();
            $table->integer('role_id')->unsigned()->index();
            $table->integer('permissions_id')->unsigned()->index();
            $table->timestamps();
        } );
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}