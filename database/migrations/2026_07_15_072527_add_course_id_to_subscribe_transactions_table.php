<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscribe_transactions', function (Blueprint $table) {
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('cascade')->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('subscribe_transactions', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        });
    }
};
