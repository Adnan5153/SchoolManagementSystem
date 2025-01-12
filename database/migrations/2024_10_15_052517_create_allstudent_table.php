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
        Schema::create('allstudents', function (Blueprint $table) {
            $table->unsignedInteger('student_id')->primary(); // Custom student ID as the primary key
            $table->string('first_name');
            $table->string('last_name');
            $table->string('class');
            $table->string('section');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('admission_number')->nullable();
            $table->string('religion');
            $table->string('email')->unique();
            $table->unsignedBigInteger('parent_id'); // Foreign key reference to allparents
            $table->timestamps();

            // Correct foreign key definition
            $table->foreign('parent_id')
                ->references('id')
                ->on('allparents')
                ->cascadeOnUpdate()
                ->cascadeOnDelete(); // Consider cascade on delete to remove related students when a parent is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allstudents');
    }
};
