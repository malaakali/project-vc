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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('event_type')->nullable()->comment('theme_park, beach, etc.');
            $table->string('location')->nullable();
            $table->timestamp('start_datetime');
            $table->timestamp('end_datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('max_participants')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
            
            $table->index(['event_type', 'start_datetime'], 'idx_events_by_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
