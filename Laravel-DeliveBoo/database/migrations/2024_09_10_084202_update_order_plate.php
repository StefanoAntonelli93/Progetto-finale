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
            $table->integer('quantity')->nullable()->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_plate', function (Blueprint $table) {
            $table->integer('quantity')->nullable(false)->default(null)->change();
        });
    }
};
