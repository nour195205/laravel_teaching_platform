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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // اسم الاجتماع
            $table->string('grade'); // الصف الدراسي المرتبط
            $table->text('embed_code'); // رابط غرفة Jitsi
            $table->boolean('is_active')->default(true); // هل الاجتماع نشط
            $table->timestamp('start_time')->nullable(); // وقت البدء
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
