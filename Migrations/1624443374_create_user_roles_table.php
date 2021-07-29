<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateUserRolesTable
{
    private $name = 'user_roles';

    public function up()
    {
        Capsule::schema()->create($this->name, function(Blueprint $table) {
            $table->id([ 'role_id', 'user_id' ]);
            $table->timestamps();

           $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
           $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        } );
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}