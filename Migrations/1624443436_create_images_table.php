<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable
{
    /** @var string $name Table name */
    private $name = 'images';

    public function up()
    {
        Capsule::schema()->create($this->name, function( Blueprint $table) {
            $table->id();
            $table->string('object_type')->index();
            $table->unsignedBigInteger('object_id')->index();
            $table->string('path');
            $table->string('type')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->drop($this->name);
    }
}