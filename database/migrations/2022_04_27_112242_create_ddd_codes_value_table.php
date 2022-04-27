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
        Schema::create('ddd_codes_value', function (Blueprint $table) {
            $table->id();
            $table->string('origin', 3);
            $table->string('destination', 3);
            $table->decimal('pricePerMinute', 15,2);
            $table->integer('identificator');
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
        Schema::dropIfExists('ddd_codes_value');
    }
};
