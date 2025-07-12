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
        Schema::create('event_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->timestamp('purchase_date')->useCurrent();
            $table->date('visit_date');
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('active');
            $table->string('confirmation_code')->unique()->nullable();
            $table->timestamps();
            
            $table->index(['event_id'], 'idx_event_tickets_event');
            $table->index(['user_id'], 'idx_event_tickets_user');
            $table->index(['visit_date'], 'idx_event_tickets_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_tickets');
    }
};
