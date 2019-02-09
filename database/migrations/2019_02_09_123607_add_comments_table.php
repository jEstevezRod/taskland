<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->unsignedInteger('author');
            $table->unsignedInteger('task_id');
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {

            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('author')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');

        Schema::table('comments', function (Blueprint $table) {

            $table->dropForeign(['task_id', 'author']);

        });
    }
}
