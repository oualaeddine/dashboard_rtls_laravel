<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPieces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pieces', function (Blueprint $table) {

            $table->boolean('isInterdite')->default(false)->after('type');
            $table->text('data')->nullable()->after('isInterdite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pieces', function (Blueprint $table) {
            //
        });
    }
}
