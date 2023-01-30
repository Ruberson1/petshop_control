<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->notNullable();
            $table->string('adress')->nullable();
            $table->string('number')->nullable();
            $table->string('district')->nullable();
            $table->string('document')->unique()->nullable();
            $table->string('contact')->unique();
            $table->string('email')->unique()->safeEmail;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}