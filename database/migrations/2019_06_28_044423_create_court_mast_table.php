<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourtMastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('court_mast', function (Blueprint $table) {
            $table->integer('court_code')->length(4)->unsigned();
            $table->string('court_name',100);
            $table->string('court_shrt_name',20);
            $table->string('court_type',2);
            $table->string('court_type_name',20);
            $table->integer('state_code')->length(4)->unsigned();
            $table->string('state_name',25);
            $table->integer('country_code')->length(3)->unsigned();
            $table->string('country_name',25);
            $table->string('court_type_shrt_name',10);
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('court_mast');
    }
}
