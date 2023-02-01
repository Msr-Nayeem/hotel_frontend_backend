<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('main_id',11);
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('country_id', 2);
            $table->integer('city_id', 2);
            $table->integer('district_id', 2);
            $table->integer('area_id', 2);
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
        Schema::dropIfExists('customers');
    }
};
