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
            $table->dropForeign('booking_id_transaction_foreign');
            $table->dropColumn('id_transaction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->unsignedBigInteger('id_transaction')->after('id_room');
            $table->foreign('id_transaction')->references('id')->on('transaction');
        });
    }
};
