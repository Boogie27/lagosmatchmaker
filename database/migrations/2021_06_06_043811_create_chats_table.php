<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id('chat_id');
            $table->string('chat_token');
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->text('chat');
            $table->string('type');
            $table->tinyInteger('sender_delete')->default('0');
            $table->tinyInteger('receiver_delete')->default('0');
            $table->tinyInteger('is_seen')->default('0');
            $table->timestamp('time');
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
        Schema::dropIfExists('chats');
    }
}
