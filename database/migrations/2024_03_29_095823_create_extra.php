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
        Schema::create('extra', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'outcome']);
            $table->integer('amount');
            $table->string('description');
            $table->unsignedBigInteger('id_booking');
            $table->foreign('id_booking')->references('id')->on('booking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra');
    }
};
