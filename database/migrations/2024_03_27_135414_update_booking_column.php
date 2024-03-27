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
        Schema::table('booking', function(Blueprint $table) {
            $table->string('external_id')->after('date');
            $table->string('payment_url')->after('external_id');
            $table->dropColumn('status_booking');
            $table->string('status')->after('payment_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn('external_id');
            $table->dropColumn('payment_url');
            $table->dropColumn('status');
            $table->enum('status_booking', ['inprogress', 'accepted', 'reschedule', 'cancelled'])->after('date');
        });
    }
};
