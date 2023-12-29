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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userid')->constrained('users');
            $table->foreignId('positionId')->constrained('positions');
            $table->foreignId('departmentId')->constrained('departments');
            $table->string('first_name', 60);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 60);
            $table->string('suffix', 10)->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 200)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_hire')->nullable();
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_number', 20)->nullable();
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
