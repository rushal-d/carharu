<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeInModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->mediumText('model_description')->nullable();
            $table->integer('model_body_type_id');
            $table->float('price')->nullable()->change();
            $table->float('mileage')->nullable()->change();
            $table->float('engine')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->dropColumn('model_description');
            $table->dropColumn('model_body_type_id');
            $table->integer('price')->nullable();
            $table->integer('mileage')->nullable();
            $table->integer('engine')->nullable();
        });
    }
}
