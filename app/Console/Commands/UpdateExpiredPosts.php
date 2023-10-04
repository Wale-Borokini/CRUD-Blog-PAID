<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class UpdateExpiredPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:update-expired-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update expired posts to Regular plan';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredPosts = Post::where('posting_plan_id', '!=', 1) // Exclude Regular plan
            ->where('expiration_date', '<', Carbon::now())
            ->get();

        foreach ($expiredPosts as $post) {
            // Set the posting plan to Regular (assuming Regular plan has ID 1)
            $post->update([
                'posting_plan_id' => 1,
                'post_priority' => 1,
            ]);
        }

        $this->info(count($expiredPosts) . ' posts updated to Regular plan.');
    }
}