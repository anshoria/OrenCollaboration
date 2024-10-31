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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover_img');
            $table->string('banner_img')->nullable();
            $table->string('category');
            $table->text('overview');
            $table->text('key_highlights');
            $table->text('approach');
            $table->text('gallery');
            $table->string('venue');
            $table->string('attendees')->nullable();
            $table->text('review')->nullable();
            $table->string('reviewer')->nullable();
            $table->string('company_review')->nullable();
            $table->timestamp('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
