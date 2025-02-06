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
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->timestamps();

            // Ensure uniqueness per class
            $table->unique(['name', 'class_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
