<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->unsignedInteger('author')->nullable();
            $table->unsignedInteger('project')->nullable();
            $table->timestamps();
        });

        Schema::table('states', function (Blueprint $table) {

            $table->foreign('author')->references('id')->on('users');

            $table->foreign('project')->references('id')->on('projects');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');

        Schema::table('states', function (Blueprint $table) {

            $table->dropForeign('author');
            $table->dropForeign('project');

        });    }
}
