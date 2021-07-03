<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto', function (Blueprint $table){
          $table->tinyIncrements('id');
          $table->string('nombre',50);
          $table->string('ap_paterno',40);
          $table->string('ap_materno',40)->nullable();
          $table->date('dateOfBirth')->nullable();
          $table->string('alias',10)->nullable();
          $table->string('path_photo',50)->nullable();
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacto');
    }
}
