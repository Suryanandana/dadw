<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_booking');
            $table->unsignedBigInteger('id_services');
            $table->unsignedBigInteger('id_room');
            $table->timestamps();

            $table->foreign('id_booking')->references('id')->on('booking');
            $table->foreign('id_services')->references('id')->on('services');
            $table->foreign('id_room')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
