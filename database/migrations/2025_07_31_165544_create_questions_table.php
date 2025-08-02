<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');            // نص السؤال
            $table->string('option_a');            // اختيار أ
            $table->string('option_b');            // اختيار ب
            $table->string('option_c');            // اختيار ج
            $table->string('option_d');            // اختيار د
            $table->string('correct_option');      // الإجابة الصحيحة (a, b, c, d)
            $table->enum('grade', ['first', 'second', 'third']);  // السنة الدراسية
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
