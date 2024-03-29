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
            $table->dropForeign('booking_id_staff_foreign');
            $table->dropColumn('id_staff');
            $table->integer('total')->after('id');
            $table->tinyInteger('pax')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking', function(Blueprint $table) {
            $table->unsignedBigInteger('id_staff')->nullable()->after('id_room');
            $table->foreign('id_staff')->references('id')->on('staff');
            $table->dropColumn('total');
            $table->smallInteger('pax')->change();
        });
    }
};
