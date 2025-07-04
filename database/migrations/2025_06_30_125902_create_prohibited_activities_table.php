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
        Schema::create('prohibited_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained();
            $table->string('name');
            $table->text('description');
            $table->text('justification');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prohibited_activities');
    }
};
