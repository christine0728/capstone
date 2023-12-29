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
        Schema::create('sitreps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->text('attn')->nullable();
            $table->text('from')->nullable();
            $table->foreignId('subjectId')->constrained('subjects');
            $table->text('province')->nullable();
            $table->text('general_weather_condition')->nullable();
            $table->text('tcws')->nullable();
            $table->foreignId('damId')->constrained('dams');
            $table->text('related_incident')->nullable();
            $table->integer('affected_population')->nullable();
            $table->text('casualties')->nullable();
            $table->foreignId('roads_and_bridgesId')->constrained('road_bridges');
            $table->text('power')->nullable();
            $table->text('water')->nullable();
            $table->text('communication_lines')->nullable();
            $table->text('status_of_airports')->nullable();
            $table->text('status_of_flights')->nullable();
            $table->text('status_of_seaports')->nullable();
            $table->text('stranded_passengers')->nullable();
            $table->integer('partial_damaged_house')->nullable();
            $table->integer('total_damaged_house')->nullable();
            $table->integer('damage_to_agriculture')->nullable();
            $table->integer('damage_to_livestock')->nullable();
            $table->integer('damage_to_infrastructure')->nullable();
            $table->boolean('class_suspension')->nullable();
            $table->boolean('work_suspension')->nullable();
            $table->boolean('state_of_calamity')->nullable();
            $table->text('preemptive_evacuation')->nullable();
            $table->text('preemptive_evacuation_animals')->nullable();
            $table->text('assistance_provided')->nullable();
            $table->longText('disaster_preparedness')->nullable();
            $table->text('food_and_non_food')->nullable();
            $table->text('pccm')->nullable();
            $table->text('health')->nullable();
            $table->text('search_rescue_retrieval')->nullable();
            $table->text('logistics')->nullable();
            $table->text('emergency_telecommunications')->nullable();
            $table->text('education')->nullable();
            $table->text('clearing_operations')->nullable();
            $table->text('damage_assessment_needs_analysis')->nullable();
            $table->text('law_order')->nullable();
            $table->foreignId('sitrepDeveloperId')
            ->constrained('personnels'); 
            $table->string('preview_prepared')->nullable();
            $table->foreignId('ldrrmoId')
                ->constrained('personnels');   
            $table->string('preview_ldrrmo')->nullable();       
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sitreps');
    }
};
