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
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('post_priority')->nullable()->after('posting_plan_id');
        });

        Schema::table('plans', function (Blueprint $table) {
            $table->integer('priority')->nullable()->after('plan_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_table_and_plans', function (Blueprint $table) {
            //
        });
    }
};
