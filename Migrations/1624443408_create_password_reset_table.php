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
            $table->unsignedBigInteger('user_id');
            $table->string('token')->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        } );
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}