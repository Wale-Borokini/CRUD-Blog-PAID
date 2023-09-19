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
        // Schema::table('images', function (Blueprint $table) {
        //     $table->string('slug', 191)->nullable()->unique()->after('id');
        // });

        $images = App\Models\Image::all();

        foreach ($images as $image) {
            $addCurrentTime = time();
            $randSlug = Str::random(20);
            $slug = "{$addCurrentTime}-{$randSlug}";
            $image->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('image', function (Blueprint $table) {
            //
        });
    }
};
