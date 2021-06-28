<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable
{
    private $name = 'roles';

    public function up()
    {
        Capsule::schema()->create($this->name, function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index();
            $table->text('description');
            $table->timestamps();
        } );
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}