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
            $table->integer('user_id')->index();
            $table->string('token')->index();
            $table->boolean('extended');
            $table->dateTime('expires_at');
            $table->timestamps();
        } );
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}