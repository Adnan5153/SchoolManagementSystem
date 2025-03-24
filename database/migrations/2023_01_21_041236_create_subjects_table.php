<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('class_id'); // Foreign key to classes table
            $table->unsignedBigInteger('teacher_id')->nullable(); // Foreign key to teachers table
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

            // Ensure uniqueness per class
            $table->unique(['name', 'class_id']);
        });
    }


    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
