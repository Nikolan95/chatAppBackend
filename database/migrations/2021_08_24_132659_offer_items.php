<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OfferItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offeritems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('message_id')->unsigned();
            $table->string('articleNumber');
            $table->string('name');
            $table->integer('amount');
            $table->integer('price');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');

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
