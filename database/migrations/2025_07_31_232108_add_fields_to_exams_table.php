<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('embed_code');
            $table->timestamp('start_time')->nullable()->after('is_active');
            $table->timestamp('end_time')->nullable()->after('start_time');
        });
    }

    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'start_time', 'end_time']);
        });
    }



};
