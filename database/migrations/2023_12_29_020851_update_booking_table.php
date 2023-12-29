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
        Schema::table('booking', function (Blueprint $table) {
            $table->unsignedBigInteger('id_customer')->nullable()->change();
            $table->unsignedBigInteger('id_staff')->nullable()->change();
            $table->unsignedBigInteger('id_transaction')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->unsignedBigInteger('id_customer')->change();
            $table->unsignedBigInteger('id_staff')->change();
            $table->unsignedBigInteger('id_transaction')->change();
        });
    }
};
