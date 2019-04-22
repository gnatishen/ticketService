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
            $table->bigIncrements('id');
            $table->string('ticket_article');
            $table->string('fio');
            $table->string('phone');
            $table->string('city')->nullable();
            $table->string('adress')->nullable();
            $table->string('email')->nullable();
            $table->enum('type', ['Ремонт', 'Запчастини','Дефект']);
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('date_sale')->nullable();
            $table->longText('description')->nullable();
            $table->longText('files')->nullable();
            $table->longText('answer')->nullable();
            $table->enum('status', ['Відкрита', 'В обробці','Закрита']);
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
