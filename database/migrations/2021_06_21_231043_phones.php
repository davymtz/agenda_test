<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Phones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('phones', function (Blueprint $table){
        $table->smallIncrements('id');
        $table->string('tag',30)->nullable();
        $table->string('phone',10);
        $table->timestamps();
        $table->softDeletes();
        $table->unsignedTinyInteger('user_phone_fk');
        $table->foreign('user_phone_fk')->references('id')->on('contacto');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('phones', function (Blueprint $table){
        $table->dropForeign(['user_phone_fk']);
      });
      Schema::dropIfExists('phones');
    }
}
