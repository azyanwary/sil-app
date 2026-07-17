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
        Schema::create('facility_usage_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('heritage_site_id')->constrained('heritage_sites')->cascadeOnDelete();
            $table->string('applicant_name');
            $table->string('identity_number');
            $table->string('institution_name')->nullable();
            $table->string('activity_type');
            $table->text('activity_description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedSmallInteger('duration_days');
            $table->unsignedInteger('participant_count');
            $table->string('application_letter_path');
            $table->enum('status', ['submitted', 'verified', 'approved', 'rejected', 'completed', 'cancelled'])->default('submitted');
            $table->text('approval_notes')->nullable();
            $table->string('permit_number')->nullable()->unique();
            $table->unsignedInteger('fee_amount')->nullable()->default(0);
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index(['heritage_site_id', 'start_date', 'end_date']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_usage_requests');
    }
};
