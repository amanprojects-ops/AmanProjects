<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_social_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->enum('platform', ['instagram', 'facebook', 'linkedin', 'twitter', 'youtube', 'yelp', 'other'])->index();
            $table->text('profile_url');
            $table->string('handle')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['lead_id', 'platform']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_social_profiles');
    }
};
