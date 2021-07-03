<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Address extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
          $table->smallIncrements('id');
          $table->string('address',100);
          $table->timestamps();
          $table->softDeletes();
          $table->unsignedTinyInteger('user_address_fk');
          $table->foreign('user_address_fk')->references('id')->on('contacto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('address', function (Blueprint $table){
        $table->dropForeign(['user_address_fk']);
      });
      Schema::dropIfExists('address');
    }
}
