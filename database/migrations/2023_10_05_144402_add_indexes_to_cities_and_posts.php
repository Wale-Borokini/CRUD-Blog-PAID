<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::table('cities', function (Blueprint $table) {
    //         $table->index('slug');
    //         $table->index('name');
    //     });

    //     Schema::table('countries', function (Blueprint $table) {
    //         $table->index('slug');
    //         $table->index('name');
    //     });

    //     Schema::table('pagelogs', function (Blueprint $table) {
    //         $table->index('slug');
    //         $table->index('username');
    //         $table->index('email');
    //     });

    //     Schema::table('users', function (Blueprint $table) {
    //         $table->index('slug');
    //         $table->index('created_at');
    //         $table->index('username');
    //         $table->index('email');
    //         $table->index('credit_balance');
    //     });

    //     Schema::table('transactions', function (Blueprint $table) {
    //         $table->index('slug');
    //         $table->index('created_at');
    //         $table->index('email');
    //         $table->index('transaction_type');
    //     });

    //     Schema::table('states', function (Blueprint $table) {
    //         $table->index('slug');
    //         $table->index('name');
    //     });

    //     Schema::table('posts', function (Blueprint $table) {
    //         $table->index('slug');
    //         $table->index('post_priority');
    //         $table->index('created_at');
    //         $table->index('post_title');
    //         $table->index('post_description');
    //         $table->index('height');
    //         $table->index('name');
    //         $table->index('phone_number');
    //         $table->index('email');
    //     });
    
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities_and_posts', function (Blueprint $table) {
            //
        });
    }
};
