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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('continent');
            $table->string('region');
            $table->float('gdp')->nullable();
            $table->float('hdi')->nullable();
            $table->string('official_language')->nullable();
            $table->integer('independence_year')->nullable();
            $table->integer('ilo_conventions')->default(0);
            $table->integer('hazardous_activities_approval_year')->nullable();
            $table->string('sst_legislation_robustness')->nullable();
            $table->float('youth_percentage')->nullable();
            $table->float('children_percentage')->nullable();
            $table->text('gdp_contributing_sectors')->nullable();
            $table->text('employment_sectors')->nullable();
            $table->string('education_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
