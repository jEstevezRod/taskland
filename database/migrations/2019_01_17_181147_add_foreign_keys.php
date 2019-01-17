<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();


        Schema::table('tasks', function (Blueprint $table) {

            $table->foreign('author')->references('id')->on('users');

            $table->foreign('project_id')->references('id')->on('projects');

        });
        Schema::table('projects', function (Blueprint $table) {

            $table->foreign('team_id')->references('id')->on('teams');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['team_id', 'project_id']);

        });
        Schema::table('tasks', function (Blueprint $table) {

            $table->dropForeign(['author', 'project_key']);

        });
        Schema::table('projects', function (Blueprint $table) {

            $table->dropForeign('team_id');

        });
    }
}
