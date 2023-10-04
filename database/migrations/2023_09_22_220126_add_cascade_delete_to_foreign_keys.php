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
        Schema::table('cities', function (Blueprint $table) {
            // Change the data type of country_id and state_id columns to BIGINT
            $table->bigInteger('country_id')->change();
            $table->bigInteger('state_id')->change();
        });
        
        Schema::table('states', function (Blueprint $table) {
            // Change the data type of country_id and state_id columns to BIGINT
            $table->bigInteger('country_id')->change();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
