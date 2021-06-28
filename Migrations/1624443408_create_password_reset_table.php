<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordResetTable
{
    private $name = 'password_reset_tokens';

    public function up()
    {
        Capsule::schema()->create($this->name, function(Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->index();
            $table->string('token')->index();
            $table->timestamps();
        } );
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}