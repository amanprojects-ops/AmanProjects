<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->index('status');
            $table->index('slug');
            $table->index('published_at');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->index('status');
            $table->index('featured');
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->index('show');
            $table->index('category');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->index('read');
        });

        Schema::table('social_links', function (Blueprint $table) {
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['slug']);
            $table->dropIndex(['published_at']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['featured']);
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->dropIndex(['show']);
            $table->dropIndex(['category']);
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropIndex(['read']);
        });

        Schema::table('social_links', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });
    }
};
