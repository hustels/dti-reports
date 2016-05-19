<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('errors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oracle_id')->nullable();
            $table->integer('chinas_id')->nullable();
            $table->integer('srvmasts_id')->nullable();
             $table->integer('vicalvaros_id')->nullable();
            $table->integer('australias_id')->nullable();
            $table->integer('francias_id')->nullable();
            
            $table->string('path');
            $table->foreign('oracle_id')->references('id')->on('oraclereports')->onDelete('cascade');
            $table->foreign('chinas_id')->references('id')->on('chinas')->onDelete('cascade');
            $table->foreign('srvmasts_id')->references('id')->on('srvmasts')->onDelete('cascade');
            $table->foreign('australias_id')->references('id')->on('australias')->onDelete('cascade');
            $table->foreign('francias_id')->references('id')->on('francias')->onDelete('cascade');
            $table->foreign('vicalvaros_id')->references('id')->on('vicalvaros')->onDelete('cascade');
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
        Schema::drop('errors');
    }
}
