<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityMastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_mast', function (Blueprint $table) {
            $table->integer('city_code')->length(4)->unsigned();
            $table->string('city_name',85);
            $table->integer('country_code')->length(3)->unsigned();
            $table->integer('state_code')->length(4)->unsigned();
            $table->float('latitude',8,2);
            $table->float('longitude',8,2);
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
        Schema::dropIfExists('city_mast');
    }
}
