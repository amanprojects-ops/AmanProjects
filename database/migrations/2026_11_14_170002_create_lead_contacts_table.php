<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->enum('type', ['email', 'phone', 'mobile', 'whatsapp'])->index();
            $table->string('value');
            $table->string('normalized_value')->index();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_offline_valid')->default(false);
            $table->boolean('is_online_valid')->default(false);
            $table->string('validation_provider')->nullable();
            $table->json('validation_details')->nullable();
            $table->timestamps();

            $table->unique(['lead_id', 'type', 'normalized_value']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_contacts');
    }
};
