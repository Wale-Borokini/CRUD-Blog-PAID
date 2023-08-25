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
        $states = App\Models\State::all();

        foreach ($states as $state) {
            $addCurrentTime = time();
            $randSlug = Str::random(15);
            $slug = Str::slug($state->name) . "-" . $addCurrentTime . "-" . $randSlug;
            $state->update(['slug' => $slug]);
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
