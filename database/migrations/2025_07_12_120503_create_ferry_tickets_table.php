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
        Schema::create('ferry_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained('ferry_schedules')->onDelete('cascade');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade')->comment('Enforces hotel booking requirement');
            $table->timestamp('purchase_date')->useCurrent();
            $table->date('departure_date');
            $table->integer('number_of_passengers')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('active');
            $table->string('confirmation_code')->unique()->nullable();
            $table->timestamps();
            
            $table->index(['booking_id'], 'idx_ferry_tickets_booking');
            $table->index(['user_id'], 'idx_ferry_tickets_user');
            $table->index(['schedule_id', 'departure_date'], 'idx_ferry_tickets_schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ferry_tickets');
    }
};
