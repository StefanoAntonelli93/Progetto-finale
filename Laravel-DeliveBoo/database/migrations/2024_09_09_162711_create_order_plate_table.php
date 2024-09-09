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
        Schema::create('order_plate', function (Blueprint $table) {
            $table->id();

            // creo foreign key di order e plate che si indirizzano automaticamente alle tabelle orders e plates con constrained e in cui una volta cancellato un campo in queste tabelle automaticamente si eliminano anche le FK

            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            $table->foreignId('plate_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_plate');
    }
};
