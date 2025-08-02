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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'student'])->default('student')->after('email');
            $table->string('phone')->nullable()->after('role');
            $table->string('guardian_name')->nullable()->after('phone');
            $table->string('guardian_phone')->nullable()->after('guardian_name');
            $table->enum('grade', ['first', 'second', 'third', 'fourth', 'fifth', 'sixth'])->nullable()->after('guardian_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
