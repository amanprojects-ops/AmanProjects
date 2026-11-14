<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_opt_outs', function (Blueprint $table) {
            $table->id();
            $table->string('email_hash', 64)->nullable()->unique();
            $table->string('domain_hash', 64)->nullable()->unique();
            $table->string('phone_hash', 64)->nullable()->unique();
            $table->string('reason')->nullable();
            $table->ipAddress('requested_by_ip')->nullable();
            $table->timestamp('opted_out_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_opt_outs');
    }
};
