<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('resident_id')->unsigned()->index();
            $table->bigInteger('pensionaire_id')->unsigned()->index();
            $table->bigInteger('duration');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->timestamps();

            $table->foreign('resident_id')->references('id')
                ->on('persons')->onDelete('cascade');

            $table->foreign('pensionaire_id')->references('id')
                ->on('persons')->onDelete('cascade');
        });
    }//id, resident_name, pensionaire_name, date_start, date_end ,duration

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seances');
    }
}
