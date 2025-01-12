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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('student_id');  // Student ID reference
            $table->unsignedInteger('teacher_id_number');  // Teacher ID reference
            $table->string('subject');  // Subject name
            $table->integer('marks');  // Marks given
            $table->text('remarks')->nullable();  // Optional remarks
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('student_id')->references('student_id')->on('allstudents')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('teacher_id_number')->references('teacher_id_number')->on('allteachers')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
