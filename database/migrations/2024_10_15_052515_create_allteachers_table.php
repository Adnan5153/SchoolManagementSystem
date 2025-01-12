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
        Schema::create('allteachers', function (Blueprint $table) {
            $table->unsignedInteger('teacher_id_number')->primary(); // Primary key for teachers

            // Changing the type of 'class' and 'subject' to string to support names like 'PG', 'Bangla', etc.
            $table->string('class');
            $table->string('subject');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('section');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->date('joining_date');
            $table->string('nid_number');
            $table->string('religion');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allteachers');
    }
};
