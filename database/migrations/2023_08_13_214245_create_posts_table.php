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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 191)->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('country_id');
            $table->bigInteger('state_id');
            $table->bigInteger('city_id');
            $table->text('post_title')->nullable();
            $table->text('post_description')->nullable();
            $table->bigInteger('age');
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('gender_id')->nullable();
            $table->bigInteger('ethnicity_id')->nullable();
            $table->bigInteger('hair_id')->nullable();
            $table->bigInteger('eyes_id')->nullable();
            $table->string('height')->nullable();
            $table->string('availability')->nullable();
            $table->text('availability_details')->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('posting_plan_id')->nullable();
            $table->date('valid_till')->nullable();                            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
