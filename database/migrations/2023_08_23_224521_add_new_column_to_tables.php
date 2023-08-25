<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //countries,states,cities,ethnicities,eyes,hairs,genders'
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('name');
        });

        Schema::table('states', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('name');
        });
        
        Schema::table('cities', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('name');
        });

        Schema::table('ethnicities', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('name');
        });

        Schema::table('eyes', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('name');
        });

        Schema::table('hairs', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('name');
        });

        Schema::table('genders', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
