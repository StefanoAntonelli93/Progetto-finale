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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id')
                ->nullable();

            // setting the field to null when deleting something from main table

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->nullOnDelete();


            $table->datetime('order_date');
            $table->string('customer_name', 100);
            $table->string('delivery_address', 255);
            $table->decimal('price', 8, 2)->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
