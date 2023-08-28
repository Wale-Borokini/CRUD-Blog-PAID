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
        Schema::table('transactions', function (Blueprint $table) {
            // $table->renameColumn('username', 'user_id');
            $table->integer('user_id')->change();
            $table->integer('performed_by')->change();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->integer('is_admin')->default(0)->change();
            $table->integer('is_super_admin')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('integer_in_users', function (Blueprint $table) {
            //
        });
    }
};
