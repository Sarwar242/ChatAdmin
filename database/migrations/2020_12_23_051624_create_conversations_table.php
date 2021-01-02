<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('user_one')->nullable();
            $table->unsignedBigInteger('user_two')->nullable();
            $table->unsignedTinyInteger('status')->nullable();
            $table->timestamps();

            $table->foreign('user_one')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreign('user_two')
            ->references('id')->on('admins')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
