<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('class_routines', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('class_id'); // Foreign key to 'classes' table
            $table->unsignedBigInteger('subject_id'); // Foreign key to 'subjects' table
            $table->unsignedInteger('teacher_id_number'); // Must match the exact type in 'allteachers'
            $table->string('day_of_week'); // Monday, Tuesday, etc.
            $table->time('start_time'); // Start time of the class
            $table->time('end_time'); // End time of the class
            $table->string('room_number')->nullable(); // Optional room number
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('teacher_id_number')->references('teacher_id_number')->on('allteachers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('class_routines');
    }
};
