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
        Schema::create('heritage_sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_category_id')->constrained('site_categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('address');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->json('operating_hours')->nullable();
            $table->unsignedInteger('admission_fee')->nullable()->default(0);
            $table->string('registration_number')->nullable()->unique();
            $table->year('designation_year')->nullable();
            $table->enum('status', ['active', 'under_renovation', 'temporarily_closed'])->default('active');
            $table->boolean('is_facility_available')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('site_category_id');
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heritage_sites');
    }
};
