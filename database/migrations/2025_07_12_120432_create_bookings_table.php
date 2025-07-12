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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('number_of_guests');
            $table->decimal('total_price', 10, 2);
            $table->timestamp('booking_date')->useCurrent();
            $table->string('status')->default('confirmed');
            $table->string('confirmation_code')->unique()->nullable();
            $table->timestamps();
            
            $table->index(['user_id'], 'idx_bookings_user');
            $table->index(['room_id', 'check_in_date', 'check_out_date'], 'idx_bookings_room_dates');
            $table->index(['confirmation_code'], 'idx_bookings_confirmation');
            $table->index(['status', 'check_in_date'], 'idx_bookings_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
