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
        Schema::table('order', function (Blueprint $table) {
            // drop column id_room from table room
            $table->dropForeign(['id_room']);
            $table->dropColumn('id_room');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            // add column id_room from table room
            $table->unsignedBigInteger('id_room');
            $table->foreign('id_room')->references('id')->on('rooms');
        });
    }
};
