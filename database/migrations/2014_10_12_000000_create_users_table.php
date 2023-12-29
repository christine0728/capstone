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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('usertype')->default('mdrrmo');
            $table->string('officer')->nullable();
            $table->string('image', 2048)->nullable();
            $table->text('population')->nullable();
            $table->string('name');
            $table->text('location')->nullable();
            $table->text('contact_number', 50)->nullable();
            $table->text('emergency_number', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('login_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
