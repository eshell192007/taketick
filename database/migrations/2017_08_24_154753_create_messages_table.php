<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id_message');
            $table->string('email')->nullable();
            $table->string('subject');
            $table->string('detail');
            $table->unsignedInteger('id_from')->nullable();
            $table->foreign('id_from')->references('id')->on('users');
            $table->unsignedInteger('id_ticket')->nullable();
            $table->foreign('id_ticket')->references('id_ticket')->on('tickets');
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
        Schema::dropIfExists('messages');
    }
}
