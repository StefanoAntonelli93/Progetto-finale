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
        //
        Schema::table('restaurants', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id']);

            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Add the new foreign key constraint with ON DELETE CASCADE
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('restaurants', function (Blueprint $table) {
            // Drop the foreign key with ON DELETE CASCADE
            $table->dropForeign(['user_id']);

            // Re-add the original foreign key constraint (without CASCADE)
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null'); // or 'restrict' based on your original setup
        });
    }
};
