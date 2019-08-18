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
            $table->increments('id');
            $table->integer('order')->nullable(false)->unsigned();
            $table->integer('customer')->nullable(false)->unsigned();
            $table->string('title', 255);
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order')->references('id')->on('orders');
            $table->foreign('customer')->references('id')->on('customers');

            $table->unique(['order', 'customer']);
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
