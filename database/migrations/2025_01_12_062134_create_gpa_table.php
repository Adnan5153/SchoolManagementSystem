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
        Schema::create('gpas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('student_id'); // Reference to the student
            $table->decimal('gpa', 4, 2); // GPA value (e.g., 4.00)
            $table->string('semester'); // Semester (e.g., Spring 2024)
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('student_id')->references('student_id')->on('allstudents')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gpas');
    }
};
