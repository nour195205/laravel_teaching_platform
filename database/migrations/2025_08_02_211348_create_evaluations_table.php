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

        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان التقييم
            $table->enum('grade', ['first', 'second', 'third', 'fourth', 'fifth', 'sixth']);
            $table->date('date'); // تاريخ التقييم
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
