<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseMastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_mast', function (Blueprint $table) {
            $table->bigIncrements('case_id');
            $table->string('case_title',200);
            $table->unsignedtinyInteger('case_type_id');
            $table->unsignedInteger('cust_id');
            $table->unsignedInteger('user_id');
            $table->unsignedtinyInteger('court_code');
            $table->unsignedmediumInteger('city_code');
            $table->string('court_name',100);
            $table->date('case_reg_date');
            $table->date('case_over_date');
            $table->string('case_number',25);
            $table->string('appellant_name',50);
            $table->string('respondant_name',50);
            $table->text('case_summary');
            $table->decimal('case_fees',9,2);
            $table->string('case_status',1);
            $table->text('case_remark');
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
        Schema::dropIfExists('case_mast');
    }
}
