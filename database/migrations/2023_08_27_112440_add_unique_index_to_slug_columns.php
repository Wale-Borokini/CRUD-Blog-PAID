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
        
    //         Schema::table('countries', function (Blueprint $table) {
    //             //$table->dropUnique('countries_slug_unique');
    //             $table->string('slug', 191)->nullable()->unique()->change(); 
    //         });

    //         Schema::table('cities', function (Blueprint $table) {
                
    //             $table->string('slug', 191)->nullable()->unique()->change(); 
    //         });


    //         Schema::table('ethnicities', function (Blueprint $table) {
    //             //$table->dropUnique('ethnicities_slug_unique');
    //             $table->string('slug', 191)->nullable()->unique()->change();
    //         });

    //         Schema::table('eyes', function (Blueprint $table) {
    //             //$table->dropUnique('eyes_slug_unique');
    //             $table->string('slug', 191)->nullable()->unique()->change(); 
    //         });

    //         Schema::table('genders', function (Blueprint $table) {
                
    //             $table->string('slug', 191)->nullable()->unique()->change(); 
    //         });

    //         Schema::table('hairs', function (Blueprint $table) {
               
    //             $table->string('slug', 191)->nullable()->unique()->change(); 
    //         });

    //         Schema::table('plans', function (Blueprint $table) {
                
    //             $table->string('slug', 191)->nullable()->unique()->after('id');
    //         });

    //         Schema::table('posts', function (Blueprint $table) {
                
    //             $table->string('slug', 191)->nullable()->unique()->change(); 
    //         });

    //         Schema::table('states', function (Blueprint $table) {                
    //             $table->string('slug', 191)->nullable()->unique()->change(); 
    //         });

    //         Schema::table('transactions', function (Blueprint $table) {
                
    //             $table->string('slug', 191)->nullable()->unique()->change(); 
    //         });

    //         Schema::table('users', function (Blueprint $table) {
                
    //             $table->string('slug', 191)->nullable()->unique()->change(); 
    //         });

          
    
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slug_columns', function (Blueprint $table) {
            //
        });
    }
};
