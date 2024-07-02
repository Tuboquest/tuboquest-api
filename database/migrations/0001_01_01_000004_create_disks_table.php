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
            $table->timestamps();
            $table->string('host')->unique();
            $table->string('serial_number');
            $table->string('token');
            $table->string('name');
            $table->boolean('is_paired')->default(false);
            $table->foreignUuid('user_id')
                ->nullable()
                ->default(null)
                ->constrained('users')
                ->nullOnDelete();
            $table->integer('angle')->default(0);
            $table->string('pairing_code', 4);
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
