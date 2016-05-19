<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAustraliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('australias', function (Blueprint $table) {
          $table->increments('id');
          $table->string('date');
          $table->string('session');
          $table->text('specification');
          $table->string('host');
          $table->string('type');
          $table->string('retried');
          $table->string('new_session');
          $table->string('incident');
          $table->string('link');
          $table->string('end_ok');
          $table->text('observations');
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
        Schema::drop('australias');
    }
}
