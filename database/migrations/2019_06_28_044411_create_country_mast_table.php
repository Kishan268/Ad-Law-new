<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryMastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_mast', function (Blueprint $table) {
            $table->bigIncrements('country_code')->length(3)->unsigned();
            $table->string('country_name',80);
            $table->string('iso2',2);
            $table->string('iso3',3);
            $table->string('phone_code',10);
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
        Schema::dropIfExists('country_mast');
    }
}
