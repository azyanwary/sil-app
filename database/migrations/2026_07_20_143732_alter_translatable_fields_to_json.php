<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop unique constraint on site_categories.name because PostgreSQL cannot btree index json columns
        Schema::table('site_categories', function (Blueprint $table) {
            $table->dropUnique('site_categories_name_unique');
        });

        // site_categories
        DB::statement("ALTER TABLE site_categories ALTER COLUMN name TYPE json USING json_build_object('id', name)");
        DB::statement("ALTER TABLE site_categories ALTER COLUMN description TYPE json USING json_build_object('id', description)");

        // heritage_sites
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN name TYPE json USING json_build_object('id', name)");
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN description TYPE json USING json_build_object('id', description)");
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN address TYPE json USING json_build_object('id', address)");

        // site_photos
        DB::statement("ALTER TABLE site_photos ALTER COLUMN caption TYPE json USING json_build_object('id', caption)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: converting json back to text might lose other locales, we'll extract the 'id' locale for down migration
        DB::statement("ALTER TABLE site_categories ALTER COLUMN name TYPE varchar(255) USING name->>'id'");
        
        Schema::table('site_categories', function (Blueprint $table) {
            $table->unique('name', 'site_categories_name_unique');
        });

        DB::statement("ALTER TABLE site_categories ALTER COLUMN description TYPE text USING description->>'id'");

        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN name TYPE varchar(255) USING name->>'id'");
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN description TYPE text USING description->>'id'");
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN address TYPE text USING address->>'id'");

        DB::statement("ALTER TABLE site_photos ALTER COLUMN caption TYPE varchar(255) USING caption->>'id'");
    }
};
