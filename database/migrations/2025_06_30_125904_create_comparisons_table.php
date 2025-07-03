<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comparisons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('country1_id')->constrained('countries');
            $table->foreignId('country2_id')->constrained('countries');
            $table->text('comments')->nullable();
            $table->longText('comparison_data')->nullable();
            $table->longText('parameters');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comparisons');
    }
};