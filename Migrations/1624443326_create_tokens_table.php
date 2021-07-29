<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateTokensTable
{
    private $name = 'tokens';

    public function up()
    {
        Capsule::schema()->create($this->name, function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('token')->index();
            $table->boolean('extended');
            $table->dateTime('expires_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        } );
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}