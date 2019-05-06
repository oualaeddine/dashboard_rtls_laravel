<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('person_id')->unsigned()->index();
            $table->bigInteger('piece_id')->unsigned()->index();
            $table->dateTime('date_time');
            $table->timestamps();

            $table->foreign('person_id')->references('id')
                ->on('persons')->onDelete('cascade');

            $table->foreign('piece_id')->references('id')
                ->on('pieces')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerts');
    }
}
