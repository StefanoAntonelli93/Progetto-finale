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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            // creating new column
            $table->unsignedBigInteger('user_id')
                ->nullable()

                // setting the field to null when deleting something from main table
                ->nullOnDelete();

            $table->foreign('user_id')->references('id')->on('users');
            $table->string('restaurant_name', 100);
            $table->string('img', 255)->nullable();
            $table->string('phone_number', 20)->unique();
            $table->string('p_iva', 20)->unique();
            $table->string('address', 150);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
