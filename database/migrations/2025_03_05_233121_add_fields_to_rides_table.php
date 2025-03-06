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
        Schema::table('rides', function (Blueprint $table) {
            $table->integer('available_seats')->default(1)->after('ride_cost');
            $table->decimal('price', 10, 2)->nullable()->after('available_seats');
            $table->text('notes')->nullable()->after('price');
            $table->foreignId('vehicle_id')->nullable()->after('notes')->constrained()->onDelete('set null');
            // Make passenger_id nullable for rides that don't have passengers yet
            $table->foreignId('passenger_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rides', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropColumn(['available_seats', 'price', 'notes', 'vehicle_id']);
            $table->foreignId('passenger_id')->change();
        });
    }
};
