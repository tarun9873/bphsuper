<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();

            $table->string('name');          // site name
            $table->string('logo')->nullable(); // image
            $table->string('url')->nullable();  // site url

            $table->decimal('price', 10, 2); // per month money

            $table->string('category')->default('rental'); // always rental
            $table->string('type'); // Agent, Admin etc

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}
