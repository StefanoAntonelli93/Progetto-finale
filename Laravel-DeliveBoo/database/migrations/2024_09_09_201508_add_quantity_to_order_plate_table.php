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
        Schema::table('order_plate', function (Blueprint $table) {
            // aggiungo colonna quantità alla tabella order_plate
            $table->integer('quantity')->nullable()->after('plate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_plate', function (Blueprint $table) {
            // rimuovo colonna quantità alla tabell order_plate
            $table->dropColumn('quantity');
        });
    }
};
