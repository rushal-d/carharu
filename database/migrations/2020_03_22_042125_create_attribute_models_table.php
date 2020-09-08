<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_models', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_attribute_id');
            $table->foreign('sub_attribute_id')->references('id')->on('sub_attributes');
            $table->string('value')->nullable();
            $table->unsignedInteger('model_id');
            $table->foreign('model_id')->references('model_id')->on('models');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_models');
    }
}
