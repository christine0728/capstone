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
        Schema::create('memo_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')
            ->constrained('users')
            ->onDelete('cascade');
            $table->foreignId('memoid')->constrained('memos');
            $table->timestamp('read_at')->nullable();
            $table->timestamp('created_at')->nullable()->before('updated_at');
            $table->timestamp('updated_at')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_reads');
    }
};
