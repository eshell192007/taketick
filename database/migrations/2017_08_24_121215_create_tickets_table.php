<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id_ticket');
            $table->string('hash', 12)->unique();
            $table->unsignedInteger('id_assignee')->nullable();
            $table->unsignedInteger('id_priority')->nullable();
            $table->unsignedInteger('id_status')->nullable();
            $table->unsignedInteger('id_type')->nullable();
            $table->timestamps();
            $table->foreign('id_assignee')->references('id')->on('users');
            $table->foreign('id_priority')->references('id_priority')->on('priorities');
            $table->foreign('id_status')->references('id_status')->on('statuses');
            $table->foreign('id_type')->references('id_type')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
