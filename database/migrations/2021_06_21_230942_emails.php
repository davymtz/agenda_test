<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Emails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('emails', function (Blueprint $table){
        $table->smallIncrements('id');
        $table->string('email',80);
        $table->timestamps();
        $table->softDeletes();
        $table->unsignedTinyInteger('user_email_fk');
        $table->foreign('user_email_fk')->references('id')->on('contacto');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('emails', function (Blueprint $table){
        $table->dropForeign(['user_email_fk']);
      });
      Schema::dropIfExists('emails');
    }
}
