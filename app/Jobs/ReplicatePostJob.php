<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use App\Models\City;
use App\Models\Image;
use Auth;
use DB;
use Alert;
use File;


class ReplicatePostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $postId;

    public function __construct($postId)
    {
        $this->postId = $postId;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $postId = $this->postId;
        
        $originalPost = Post::with('images')->find($postId);

        if (!$originalPost) {
            // Handle the case where the original post is not found
            abort(404, 'Original post not found');
        }

        $originalCity = $originalPost->city;        

        $otherCities = City::where('id', '!=', $originalCity->id)->where('country_id', '=', $originalCity->country_id)->get();

        foreach ($otherCities as $city) {
            // Check if a post with the same attributes already exists in the target city
            $existingPost = Post::where([
                'user_id' => $originalPost->user_id, 'country_id' => $city->country_id, 
                'state_id' => $city->state_id, 'city_id' => $city->id, 'post_title' => $originalPost->post_title, 
                'post_description' => $originalPost->post_description, 'age' => $originalPost->age,
                'name' => $originalPost->name, 'phone_number' => $originalPost->phone_number,
                'email' => $originalPost->email, 'gender_id' => $originalPost->gender_id,
                'ethnicity_id' => $originalPost->ethnicity_id, 'hair_id' => $originalPost->hair_id,
                'eye_id' => $originalPost->eye_id, 'height' => $originalPost->height,
                'availability' => $originalPost->availability, 'availability_details' => $originalPost->availability_details,
                'address' => $originalPost->address, 'posting_plan_id' => $originalPost->posting_plan_id,
                'post_priority' => $originalPost->post_priority, 'expiration_date' => $originalPost->expiration_date,
                
            ])->first();

            // If an identical post exists in the target city, skip replication for this city
            if (!$existingPost) {
                // Create a new post in the current city using the data from the original post
                $newPost = new Post([
                    'user_id' => $originalPost->user_id, 'country_id' => $city->country_id,
                    'state_id' => $city->state_id, 'city_id' => $city->id, 'post_title' => $originalPost->post_title, 
                    'post_description' => $originalPost->post_description, 'age' => $originalPost->age, 
                    'name' => $originalPost->name, 'phone_number' => $originalPost->phone_number, 
                    'email' => $originalPost->email, 'gender_id' => $originalPost->gender_id, 
                    'ethnicity_id' => $originalPost->ethnicity_id, 'hair_id' => $originalPost->hair_id, 
                    'eye_id' => $originalPost->eye_id, 'height' => $originalPost->height, 
                    'availability' => $originalPost->availability, 'availability_details' => $originalPost->availability_details, 
                    'address' => $originalPost->address, 'posting_plan_id' => $originalPost->posting_plan_id, 
                    'post_priority' => $originalPost->post_priority, 'expiration_date' => $originalPost->expiration_date,
                    
                ]);

                $newPost->save();

                // Create new images for the new post based on the original post's images
                foreach ($originalPost->images as $originalImage) {
                    $newImage = new Image([
                        'image_url' => $originalImage->image_url,
                        'user_id' => $originalImage->user_id,
                        'post_id' => $newPost->id, // Use the ID of the new post
                    ]);

                    // Associate the new image with the new post
                    $newPost->images()->save($newImage);
                }
            }
        }
    }
}
