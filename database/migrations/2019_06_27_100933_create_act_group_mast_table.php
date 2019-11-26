<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActGroupMastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_group_mast', function (Blueprint $table) {
            $table->integer('act_group_code')->length(3)->unsigned();
            $table->string('act_group_desc',25);
            $table->string('short_desc',10);
            $table->integer('country_code')->length(4)->unsigned();
            $table->string('country_name',25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('act_group_mast');
    }
}
