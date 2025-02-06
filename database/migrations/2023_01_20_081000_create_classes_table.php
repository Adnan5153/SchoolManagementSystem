<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('class_name');
            $table->string('section')->nullable(); // Optional section (e.g., "A", "B")
            $table->integer('capacity')->nullable(); // Maximum students per class
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
};