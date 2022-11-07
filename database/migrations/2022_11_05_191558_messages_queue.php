<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MessagesQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('messages_queue', function (Blueprint $table) {
            $table->id();
            $table->foreignId("event_id");
            $table->unsignedBigInteger("telegram_id");
            $table->text("message");
            $table->boolean("is_send")->default(false);

            $table->foreign("event_id")->references("id")->on("events");
            $table->foreign("telegram_id")->references("telegram_id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
