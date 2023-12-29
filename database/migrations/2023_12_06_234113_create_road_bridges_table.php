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
        Schema::create('road_bridges', function (Blueprint $table) {
            $table->id();
            $table->integer('road_not_passable_all_type')->nullable();
            $table->integer('road_passable_all_light')->nullable();
            $table->integer('road_passable_all_type')->nullable();
            $table->integer('bridge_not_passable_all_type')->nullable();
            $table->integer('bridge_passable_all_light')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road_bridges');
    }
};
