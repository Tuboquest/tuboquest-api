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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->foreignUuid('user_id')->nullable()->default(null)->constrained('users')->nullOnDelete();
            $table->foreignUuid('plan_id')->nullable()->default(null)->constrained('plans')->nullOnDelete();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('status');
            $table->foreignUuid('payment_id')->nullable()->default(null)->constrained('payments')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
