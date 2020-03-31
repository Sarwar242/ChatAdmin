<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatinfos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->boolean('user_refresh')->default(0);
            $table->boolean('admin_refresh')->default(0);
            $table->boolean('user_initialrefresh')->default(0);
            $table->boolean('admin_initialrefresh')->default(0);
            $table->timestamps();

            $table->foreign('chat_id')
            ->references('id')->on('chats')
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
        Schema::dropIfExists('chatinfos');
    }
}
