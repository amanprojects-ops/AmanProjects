<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opportunity_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->unsignedTinyInteger('overall_score')->default(0);
            $table->unsignedTinyInteger('web_score')->default(0);
            $table->unsignedTinyInteger('mobile_score')->default(0);
            $table->unsignedTinyInteger('seo_score')->default(0);
            $table->unsignedTinyInteger('reputation_score')->default(0);
            $table->json('identified_gaps')->nullable();
            $table->json('recommended_services')->nullable();
            $table->text('executive_summary')->nullable();
            $table->string('analyzer_version', 20)->default('1.0.0');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunity_analyses');
    }
};
