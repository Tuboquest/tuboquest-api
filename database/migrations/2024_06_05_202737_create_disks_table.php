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
        Schema::create('disks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('token')
                ->unique();
            $table->timestamps();
            $table->foreignUuid('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name');
            // $table->string('license_plate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disks');
    }
};
