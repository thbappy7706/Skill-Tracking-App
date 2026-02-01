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
        Schema::create('learning_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->enum('type', ['course', 'book', 'video', 'article', 'tutorial', 'documentation', 'podcast', 'other'])->default('course');
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['planned', 'in_progress', 'completed', 'abandoned'])->default('planned');
            $table->integer('rating')->nullable(); // 1-5
            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_resources');
    }
};
