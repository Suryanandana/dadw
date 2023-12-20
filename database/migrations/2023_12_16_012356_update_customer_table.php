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
        // update table customer
        Schema::table('customer', function (Blueprint $table) {
            $table->string('address', 50)->nullable()->change();
            $table->string('country', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // rollback update table customer
        Schema::table('customer', function (Blueprint $table) {
            $table->string('address', 50)->change();
            $table->string('country', 50)->change();
        });
    }
};
