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
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');
            $table->string('tagline')->nullable()->after('slug');
            $table->string('badge')->nullable()->after('tagline');
            $table->longText('content')->nullable()->after('desc');
            $table->string('meta_title')->nullable()->after('content');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->text('meta_keywords')->nullable()->after('meta_description');
            $table->json('features')->nullable()->after('meta_keywords');
            $table->json('pricing_tiers')->nullable()->after('features');
            $table->json('process_steps')->nullable()->after('pricing_tiers');
            $table->json('faqs')->nullable()->after('process_steps');
            $table->boolean('is_active')->default(true)->after('icon_path');
            $table->integer('sort_order')->default(0)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'tagline',
                'badge',
                'content',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'features',
                'pricing_tiers',
                'process_steps',
                'faqs',
                'is_active',
                'sort_order',
            ]);
        });
    }
};
