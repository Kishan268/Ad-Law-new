<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustMastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cust_mast', function (Blueprint $table) {
            $table->bigIncrements('cust_id');
            $table->string('cust_name',100);
            $table->integer('user_id')->length(10)->unsigned();
            $table->string('name',100);
            $table->string('status_id',30)->nullable();
            $table->string('status_desc',30)->nullable();
            $table->integer('cust_type_id')->length(2)->unsigned()->nullable();
            $table->string('cust_type_name',30)->nullable();
            $table->date('regsdate')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender',1)->nullable();
            $table->string('mobile1',12)->nullable();
            $table->string('mobile2',12)->nullable();
            $table->string('fax',10)->nullable();
            $table->string('tele',25)->nullable();
            $table->string('email',100)->nullable();
            $table->string('custaddr',1000)->nullable();
            $table->integer('city_code')->length(4)->unsigned()->nullable();
            $table->string('city_name',50)->nullable();
            $table->integer('state_code')->length(4)->unsigned()->nullable();
            $table->string('state_name',25);
            $table->integer('country_code')->length(3)->unsigned()->nullable();
            $table->string('country_name',25)->nullable();
            $table->string('panno',20)->nullable();
            $table->string('gstno',30)->nullable();
            $table->string('adharno',30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cust_mast');
    }
}
