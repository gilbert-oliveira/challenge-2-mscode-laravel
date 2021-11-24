<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('users_id')->nullable()->references('id')->on('users');
            $table->foreignId('categories_id')->references('id')->on('categories');
            $table->foreignId('customers_id')->references('id')->on('customers');
            $table->string('title', 255);
            $table->longText('description')->nullable();
            $table->boolean('finished')->default(false);
            $table->boolean('reopened')->default(false);
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
        Schema::dropIfExists('tickets');
    }
}
