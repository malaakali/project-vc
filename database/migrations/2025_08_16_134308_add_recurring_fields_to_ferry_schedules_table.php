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
        Schema::table('ferry_schedules', function (Blueprint $table) {
            $table->boolean('is_recurring')->default(false);
            $table->enum('recurrence_type', ['daily', 'weekly', 'monthly'])->nullable();
            $table->integer('recurrence_interval')->default(1);
            $table->date('recurrence_end_date')->nullable();
            $table->json('days_of_week')->nullable();
            $table->foreignId('parent_schedule_id')->nullable()->constrained('ferry_schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ferry_schedules', function (Blueprint $table) {
            $table->dropColumn([
                'is_recurring',
                'recurrence_type',
                'recurrence_interval',
                'recurrence_end_date',
                'days_of_week',
                'parent_schedule_id'
            ]);
        });
    }
};
