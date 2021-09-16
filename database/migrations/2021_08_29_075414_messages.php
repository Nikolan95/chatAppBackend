<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('body')->nullable();
            $table->boolean('read');
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('conversation_id')->unsigned();
            $table->timestamps();
            $table->string('pdf')->nullable();
            $table->string('accept_offer')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');

        });
        DB::statement("ALTER TABLE messages ADD image LONGTEXT");
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
