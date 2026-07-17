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
        Schema::create('site_condition_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('heritage_site_id')->constrained('heritage_sites')->cascadeOnDelete();
            $table->foreignId('surveyor_id')->constrained('users')->cascadeOnDelete();
            $table->date('survey_date');
            $table->enum('condition', ['good', 'minor_damage', 'moderate_damage', 'severe_damage']);
            $table->text('findings');
            $table->text('recommendation')->nullable();
            $table->boolean('is_urgent')->default(false);
            $table->foreignId('responded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('responded_at')->nullable();
            $table->text('response_notes')->nullable();
            $table->timestamps();

            $table->index(['heritage_site_id', 'survey_date']);
            $table->index('condition');
            $table->index('is_urgent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_condition_reports');
    }
};
