<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRouteLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_route_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('method', 8);
            $table->string('route_name', 160)->nullable();
            $table->text('url');
            $table->string('ip', 16);
            $table->integer('user_id')->unsigned()->nullable();
            $table->text('user_agent');
            $table->timestamps();
        });

        Schema::table('user_route_logs', function ( Blueprint $table ) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_route_logs');
    }
}
