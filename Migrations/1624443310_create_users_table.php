<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable
{
    private $name = 'users';

    public function up()
    {
        Capsule::schema()->create($this->name, function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->index();
            $table->string('password')->index();
            $table->string('email')->index();
            $table->enum('type', [ 'student', 'teacher', 'admin' ])->index();
            $table->enum('status', [ 'active', 'suspended' ])->index();
            $table->timestamps();
        } );
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}