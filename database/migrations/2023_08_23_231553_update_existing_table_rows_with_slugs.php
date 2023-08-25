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
        $countries = App\Models\Country::all();

        foreach ($countries as $country) {
            $addCurrentTime = time();
            $randSlug = Str::random(15);
            $slug = Str::slug($country->name) . "-" . $addCurrentTime . "-" . $randSlug;
            $country->update(['slug' => $slug]);
        }

        $cities = App\Models\City::all();

        foreach ($cities as $city) {
            $addCurrentTime = time();
            $randSlug = Str::random(15);
            $slug = Str::slug($city->name) . "-" . $addCurrentTime . "-" . $randSlug;
            $city->update(['slug' => $slug]);
        }

        $ethnicities = App\Models\Ethnicity::all();

        foreach ($ethnicities as $ethnicity) {
            $addCurrentTime = time();
            $randSlug = Str::random(15);
            $slug = Str::slug($ethnicity->name) . "-" . $addCurrentTime . "-" . $randSlug;
            $ethnicity->update(['slug' => $slug]);
        }

        
        $hairs = App\Models\Hair::all();

        foreach ($hairs as $hair) {
            $addCurrentTime = time();
            $randSlug = Str::random(15);
            $slug = Str::slug($hair->name) . "-" . $addCurrentTime . "-" . $randSlug;
            $hair->update(['slug' => $slug]);
        }

        $eyes = App\Models\Eye::all();

        foreach ($eyes as $eye) {
            $addCurrentTime = time();
            $randSlug = Str::random(15);
            $slug = Str::slug($eye->name) . "-" . $addCurrentTime . "-" . $randSlug;
            $eye->update(['slug' => $slug]);
        }

        $genders = App\Models\Gender::all();

        foreach ($genders as $gender) {
            $addCurrentTime = time();
            $randSlug = Str::random(15);
            $slug = Str::slug($gender->name) . "-" . $addCurrentTime . "-" . $randSlug;
            $gender->update(['slug' => $slug]);
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
