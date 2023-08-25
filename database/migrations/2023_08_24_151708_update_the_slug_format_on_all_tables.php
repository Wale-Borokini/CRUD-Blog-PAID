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
            $table->string('slug', 191)->nullable()->after('id');
        });

        $countries = App\Models\Country::all();

        foreach ($countries as $country) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $country->update(['slug' => $slug]);
        }

        $states = App\Models\State::all();

        foreach ($states as $state) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $state->update(['slug' => $slug]);
        }

        $cities = App\Models\City::all();

        foreach ($cities as $city) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $city->update(['slug' => $slug]);
        }

        $ethnicities = App\Models\Ethnicity::all();

        foreach ($ethnicities as $ethnicity) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $ethnicity->update(['slug' => $slug]);
        }

        
        $hairs = App\Models\Hair::all();

        foreach ($hairs as $hair) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $hair->update(['slug' => $slug]);
        }

        $eyes = App\Models\Eye::all();

        foreach ($eyes as $eye) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $eye->update(['slug' => $slug]);
        }

        $genders = App\Models\Gender::all();

        foreach ($genders as $gender) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $gender->update(['slug' => $slug]);
        }

        $posts = App\Models\Post::all();

        foreach ($posts as $post) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $post->update(['slug' => $slug]);
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
