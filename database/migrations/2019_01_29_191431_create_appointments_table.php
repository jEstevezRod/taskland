<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('task_id')->nullable();
            $table->dateTime('from');
            $table->dateTime('to');
            $table->dateTime('date');
        });

        Schema::table('appointments', function (Blueprint $table) {

            $table->foreign('task_id')->references('id')->on('tasks');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');

        Schema::table('appointments', function (Blueprint $table) {

            $table->dropForeign(['task_id']);

        });
    }
}
