<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('slug')->index();
            $table->enum('status', [
                'new', 'verified', 'analyzed', 'contacted', 'proposal_sent', 'won', 'lost', 'disqualified'
            ])->default('new')->index();
            $table->string('category')->nullable()->index();
            $table->string('website')->nullable();
            $table->string('normalized_domain')->nullable()->index();
            $table->string('primary_phone')->nullable()->index();
            $table->string('primary_email')->nullable()->index();
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('google_place_id')->nullable()->unique();
            $table->string('google_cid')->nullable()->index();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->unsignedInteger('review_count')->default(0);

            // Provenance & Compliance
            $table->string('provenance_source')->default('extension_assisted');
            $table->text('provenance_url')->nullable();
            $table->timestamp('captured_at')->nullable();
            $table->boolean('is_opted_out')->default(false)->index();
            $table->timestamp('retention_until')->nullable()->index();

            // Assignment & Tracking
            $table->foreignId('assigned_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            // Composite indexes for fast query resolution
            $table->index(['status', 'rating']);
            $table->index(['normalized_domain', 'primary_phone']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
