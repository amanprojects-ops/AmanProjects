<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sync_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('idempotency_key', 64)->unique();
            $table->string('payload_hash', 64);
            $table->string('client_name')->default('LeadHarvest');
            $table->string('client_version')->default('1.9.1');
            $table->unsignedInteger('total_records')->default(0);
            $table->unsignedInteger('inserted_records')->default(0);
            $table->unsignedInteger('updated_records')->default(0);
            $table->unsignedInteger('skipped_records')->default(0);
            $table->unsignedInteger('failed_records')->default(0);
            $table->enum('status', ['processing', 'completed', 'failed'])->default('processing');
            $table->json('response_cache')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sync_batches');
    }
};
