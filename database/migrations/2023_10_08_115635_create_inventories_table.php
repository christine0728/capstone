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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (You can keep this)
            $table->foreignId('userId')->constrained('users'); // Assuming this is the user's ID
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers');
            $table->foreignId('catid')->nullable()->constrained('categories');
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('current_quantity');
            $table->string('location')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
