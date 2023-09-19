<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Image;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Gender;
use App\Models\Ethnicity;
use App\Models\Hair;
use App\Models\Eye;
use App\Models\Plan;
use Purifier;
use Auth;
use DB;
use Alert;
use File;

class PostsController extends Controller
{
    
    public function viewCreatePostPage()
    {

        $title = 'Create Post';
        $countries = Country::orderBy('name')->get()->unique('name');   
        $genders = Gender::orderBy('name')->get()->unique('name');
        $ethnicities = Ethnicity::orderBy('name')->get()->unique('name');
        $hairs = Hair::orderBy('name')->get()->unique('name');
        $eyes = Eye::orderBy('name')->get()->unique('name');
        $plans = Plan::orderBy('price')->get()->unique('plan_type');

        return view('pages.create-post')
        ->with(compact('title', 'countries', 'genders', 'ethnicities', 'hairs', 'eyes', 'plans'));

    }


    public function createPost(StorePostRequest $request)
    {
        $request->validated();

        $user = Auth::user();
        $postingPlanId = $request->input('posting_plan_id');
        $modelAge = $request->input('age');

        $plan = Plan::find($postingPlanId);

        if (!$plan) {
            $alerted = Alert::error('Invalid Posting Plan', 'The selected posting plan does not exist.');
            return redirect()->back()->with('alerted');
        }

        if ($modelAge < 18) {
            $alerted = Alert::error('You can\'t make this post', 'Escort must be 18 years or older.');
            return redirect()->back()->with('alerted');
        }

        $postingPlanPrice = $plan->price;
        $postingPlanDuration = $plan->duration;
        $postingPlanPriority = $plan->priority;

        if ($user->credit_balance < $postingPlanPrice) {
            $alerted = Alert::error('Insufficient Credit Balance', 'Your Credit Balance is too low to make this post');
            return redirect()->back()->with('alerted');
        }

        // Deduct the posting plan price from the credit balance
        $user->credit_balance -= $postingPlanPrice;
        $user->save();

        $postFields = $request->only([
            'country_id', 'state_id', 'city_id', 'post_title', 'post_description', 'age', 'name',
            'phone_number', 'email', 'gender_id', 'ethnicity_id', 'hair_id', 'eye_id', 'height',
            'availability', 'availability_details', 'address', 'posting_plan_id',
        ]);

        $postFields['user_id'] = $user->id;
        $postFields['post_title'] = Purifier::clean($postFields['post_title']);
        $postFields['post_description'] = Purifier::clean($postFields['post_description']);
        $postFields['availability_details'] = Purifier::clean($postFields['availability_details']);
        $postFields['post_priority'] = $postingPlanPriority;

        if ($postingPlanDuration > 0) {
            $postFields['expiration_date'] = now()->addDays($postingPlanDuration);
        }

        $post = Post::create($postFields);

        if ($request->hasFile('image_url')) {
            $imageNumbers = count($request->file('image_url'));
            if ($imageNumbers > 4) {
                $alerted = Alert::error('Error', 'You can only upload a maximum of 4 images');
                return redirect()->back()->with('alerted');
            }

            foreach ($request->file('image_url') as $imagefile) {
                $filenameWithExt = $imagefile->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $imagefile->getClientOriginalExtension();
                $randSlug = Str::random(50);
                $fileNameToStore = "{$randSlug}_" . time() . ".{$extension}";
                $path_url = $imagefile->storeAs('public/images/post_images', $fileNameToStore);
                $completeUrl = Storage::url($path_url);

                $image = new Image([
                    'image_url' => $completeUrl,
                    'user_id' => $user->id,                
                ]);

                $post->images()->save($image);
            }
        }

        $alerted =  Alert::success('Post Added', 'Your post has been added');
        return redirect()->back()->with('alerted');
    }

    public function edit(Post $post)
    {
        $this->authorize('update-post', $post);
       
        $title = 'Edit Post';
        $genders = Gender::orderBy('name')->get()->unique('name');
        $ethnicities = Ethnicity::orderBy('name')->get()->unique('name');
        $hairs = Hair::orderBy('name')->get()->unique('name');
        $eyes = Eye::orderBy('name')->get()->unique('name');

        return view('pages.edit-post')->with(compact('title', 'post', 'genders','ethnicities', 'hairs', 'eyes'));

    }    

    public function update(Request $request, Post $post)
    {
        $this->authorize('update-post', $post);

        $post->post_title = Purifier::clean($request->post_title);
        $post->post_description = Purifier::clean($request->post_description);
        $post->availability_details = Purifier::clean($request->availability_details);

        $fieldsToUpdate = $request->only([
            'age', 'name', 'phone_number', 'email', 'gender_id','ethnicity_id', 'hair_id',
            'eye_id', 'height', 'availability', 'address',
        ]);

        $modelAge = $request->input('age');
        if ($modelAge < 18) {
            $alerted = Alert::error('You can\'t make this post', 'Escort must be 18 years or older.');
            return redirect()->back()->with('alerted');
        }

        $post->fill($fieldsToUpdate)->save();

        $alerted = Alert::success('Post Edited', 'Your post has been edited');

        return redirect()->back()->with('alerted');
    }

    public function delete(Post $post)
    {
        $this->authorize('delete-post', $post);
        // Delete the images from storage
        foreach ($post->images as $image) {
            $this->deleteImageFromStorage($image->image_url);
        }

        // Delete the post and its associated images from the database
        $post->images()->delete();
        $post->delete();

        $alerted = Alert::success('Post Deleted', 'Your post has been deleted');
        return redirect()->back()->with('alerted');

    }
       
    private function deleteImageFromStorage($image_url)
    {
        // Get the path of the image file from the URL
        $path = str_replace('/storage', 'public', $image_url);

        // Check if the file exists in storage
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
   

}
