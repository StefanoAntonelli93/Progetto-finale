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
        Schema::create('plates', function (Blueprint $table) {
            $table->id();
            // creating new column
            $table->unsignedBigInteger('restaurant_id')
                ->nullable()

                // setting the field to null when deleting something from main table
                ->nullOnDelete();
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->string('img', 255)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->text('allergenes')->nullable();
            $table->boolean('available')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plates');
    }
};
