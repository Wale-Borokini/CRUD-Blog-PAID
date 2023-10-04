<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\City;
use Carbon\Carbon;

class DailyPostSelection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:post-selection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Select random posts and update their created_at';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all cities
        $cities = City::all();

        // Calculate the date that is 21 days ago
        //$oneDaysAgo = Carbon::now()->subDay();
        $threeWeeksAgo = Carbon::now()->subDays(21);

        $today = Carbon::now();
        
        

        // Loop through each city
        foreach ($cities as $city) {
            // Generate a random number between 1 and 4
            $randomCount = rand(1, 4);

            // Get random posts for the current city            
            $randomPosts = $city->posts()->whereDate('created_at', '<', $threeWeeksAgo)
                        ->where('user_id', 1)
                        ->inRandomOrder()->take($randomCount)->get();
            // Update the created_at column for each selected post
            foreach ($randomPosts as $post) {
                $post->update(['created_at' => $today]);
            }
        }

        $this->info('Random posts selected and updated successfully!');
    }
}
