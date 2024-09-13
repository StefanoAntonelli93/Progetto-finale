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
        Schema::table('plates', function (Blueprint $table) {
            //
            $table->dropForeign(['restaurant_id']);

            $table->unsignedBigInteger('restaurant_id')->nullable()->change();

            // Add the new foreign key constraint with ON DELETE CASCADE
            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plates', function (Blueprint $table) {
            // Drop the foreign key with ON DELETE CASCADE
            $table->dropForeign(['restaurant_id']);

            // Re-add the original foreign key constraint (without CASCADE)
            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->onDelete('set null'); // or 'restrict' based on your original setup
        });
    }
};
