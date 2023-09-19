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
        Schema::create('walletadresses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('btc_address', 191);  
            $table->decimal('amount', 18, 8);          
            $table->string('btc_service');            
            $table->string('added_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walletadresses');
    }
};
