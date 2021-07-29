<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateRolePermissionsTable
{
    private $name = 'role_permissions';

    public function up()
    {
        Capsule::schema()->create($this->name, function(Blueprint $table) {
            $table->id(['role_id', 'permission_id']);
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            $table->foreign('permission_id')->references('id')->on('permissions')->cascadeOnDelete();
        } );
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}