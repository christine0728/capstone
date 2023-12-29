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
        Schema::create('memo_municipalities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('memo_id');
            $table->unsignedBigInteger('municipality_id')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->unique(['memo_id', 'municipality_id']);
            $table->foreign('memo_id')->references('id')->on('memos')->onDelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('users')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_municipalities');
    }
};
