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
        Schema::create('assistance_requests', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('incidentId')->constrained('incidents')->after('id');
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('ownerId')->constrained('users');
            $table->foreignId('severityId')->constrained('severities')->after('id');
            $table->text('incident_desc')->nullable();
            $table->text('location')->nullable();
            $table->text('date_needed')->nullable();
            $table->text('date_happened')->nullable();
            $table->text('action_taken')->nullable();
            $table->string('comment')->default('None');
            $table->string('req_status')->default('Pending');
            $table->string('update_req_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistance_requests');
    }
};
