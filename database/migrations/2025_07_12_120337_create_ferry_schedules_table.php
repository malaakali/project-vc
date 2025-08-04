<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ferry_schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamp('departure_time');
            $table->timestamp('arrival_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('capacity');
            $table->decimal('price_per_ticket', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['departure_time', 'is_active'], 'idx_ferry_schedules_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ferry_schedules');
    }
};
