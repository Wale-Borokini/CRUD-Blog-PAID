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
        $plans = App\Models\Plan::all();

        foreach ($plans as $plan) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $plan->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
