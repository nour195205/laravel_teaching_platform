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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // اسم الملازم أو الكتاب
            $table->text('description')->nullable(); // وصف
            $table->string('file'); // مسار الملف المرفوع
            $table->enum('grade', ['first', 'second', 'third']); // السنة الدراسية
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
