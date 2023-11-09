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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->enum('status_booking', ['inprogress', 'accepted', 'reschedule', 'cancelled']);
            $table->smallInteger('pax');
            $table->timestamp('date');
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_staff');
            $table->unsignedBigInteger('id_transaction');
            $table->timestamps();

            $table->foreign('id_customer')->references('id')->on('users');
            $table->foreign('id_staff')->references('id')->on('staff');
            $table->foreign('id_transaction')->references('id')->on('transaction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
