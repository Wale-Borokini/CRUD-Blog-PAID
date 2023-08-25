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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_url', 199);
            $table->tinyInteger('user_id');
            $table->tinyInteger('post_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_url', 199);
            $table->tinyInteger('user_id');
            $table->tinyInteger('post_id');
            $table->timestamps();
        });
    }
};
