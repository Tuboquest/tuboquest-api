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
        Schema::create('park_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->foreignUuid('disk_id')->nullable()->default(null)->constrained('disks')->nullOnDelete();
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->foreignUuid('address_id')->nullable()->default(null)->constrained("addresses")->nullOnDelete();
            $table->boolean('is_current')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('park_sessions');
    }
};
