<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
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
use Illuminate\Support\Str;
use Auth;
use DB;
Use Alert;
use File;

class PostsController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     // $this->middleware('my-middleware')->only(['index', 'create', 'store']);
    // }
    
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
               
        // Get the logged-in user
        $user = Auth::user();

        $postingPlanId = $request->input('posting_plan_id');
        $postingPlanPrice = Plan::find($postingPlanId)->price;

        if ($user->credit_balance >= $postingPlanPrice) {
            // Deduct the posting plan price from the credit balance
            $user->credit_balance -= $postingPlanPrice;
            $user->save();
        
            

            // $adminName = Auth::user()->name;
            $userId = Auth::user()->id;
            $post = new Post;
            $post->user_id = $userId;
            $post->country_id = $request->country_id;
            // $post->body = Purifier::clean($request->body);
            $post->state_id = $request->state_id;
            $post->city_id = $request->city_id;
            $post->post_title = Purifier::clean($request->post_title);
            $post->post_description = Purifier::clean($request->post_description);
            $post->age = $request->age;
            $post->name = $request->name;
            $post->phone_number = $request->phone_number;
            $post->email = $request->email;
            $post->gender_id = $request->gender_id;
            $post->ethnicity_id = $request->ethnicity_id;
            $post->hair_id = $request->hair_id;
            $post->eye_id = $request->eye_id;
            $post->height = $request->height;
            $post->availability = $request->availability;
            $post->availability_details = Purifier::clean($request->availability_details);
            $post->address = $request->address;
            $post->posting_plan_id = $request->posting_plan_id;
            $post->valid_till = "2021-06-28 22:05:13";

            $post->save();

            if($request->hasfile('image_url'))
            {  
                // $this->validate($request, [
                
                //     'image_url.*' => ['mimes:jpeg,png,jpg,gif,svg|max:2048']
                // ]);
                                        
                $imageNumbers = count($request->file('image_url'));
                if( $imageNumbers > 4){
                    return redirect()->back()->with('error', 'You can only upload a maximum of 4 images');
                }


                foreach ($request->file('image_url') as $imagefile) {
                    $image = new Image;
                
                    $filenameWithExtPr = $imagefile->getClientOriginalName();
                    // Get just filename
                    $filenamePr = pathinfo($filenameWithExtPr, PATHINFO_FILENAME);
                    // Get just ext
                    $extensionPr = $imagefile->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStorePr= $filenamePr.'_'.time().'.'.$extensionPr;
                    // Upload path
                    $upload_path = 'post_images/';
                    // Upload Image
                    $path_url = $upload_path . $fileNameToStorePr;

                    $success = $imagefile->move($upload_path, $fileNameToStorePr);

                    $image->image_url = $path_url;
                    $image->user_id = $userId;
                    $image->post_id = $post->id;
                    $image->save();
                    
                }

            }
                    
            //$alerted = toast('Post Added', 'success');        
            $alerted = Alert::success('Post Added', 'Your post has been added');   

            return redirect()->back()->with('alerted');
        }else{
            $alerted = Alert::error('Insufficient Credit Balance', 'Your Credit Balance is too low to make this post');

            return redirect()->back()->with('alerted');
        }
        

    }

    public function edit(Post $post)
    {
        $this->authorize('update-post', $post);
       
        $title = 'Edit Post';
        $genders = Gender::orderBy('name')->get()->unique('name');
        $ethnicities = Ethnicity::orderBy('name')->get()->unique('name');
        $hairs = Hair::orderBy('name')->get()->unique('name');
        $eyes = Eye::orderBy('name')->get()->unique('name');

        //return $post;
        return view('pages.edit-post')->with(compact('title', 'post', 'genders','ethnicities', 'hairs', 'eyes'));

    }

    public function update(Request $request, Post $post)
    {
        // $request->validated();

        $post->post_title = $request->post_title;
        $post->post_description = $request->post_description;
        $post->age = $request->age;
        $post->name = $request->name;
        $post->phone_number = $request->phone_number;
        $post->email = $request->email;
        $post->gender_id = $request->gender_id;
        $post->ethnicity_id = $request->ethnicity_id;
        $post->hair_id = $request->hair_id;
        $post->eye_id = $request->eye_id;
        $post->height = $request->height;
        $post->availability = $request->availability;
        $post->availability_details = $request->availability_details;
        $post->address = $request->address;     

        $post->save();

        $alerted = Alert::success('Post Edited', 'Your post has been edited'); 

        return redirect()->back()->with('alerted');
        
    }

    public function addDeletePostImage(Post $post)
    {
        $this->authorize('update-post', $post);
       
        $title = 'Add/Delete Image';       
        
        return view('pages.add-delete-post-image')->with(compact('post'));

    }

    public function uploadImageEdit(Request $request)
    {                     

        try {
            $uploadedImages = [];
            $userId = Auth::user()->id;
            $postSlug = $request->post_slug; // Get the post slug from the request

            // Retrieve the Post model based on the post slug
            $post = Post::where('slug', $postSlug)->first();

            if (!$post) {
                return response()->json(['message' => 'Post not found'], 404);
            }

            // Check the total number of images associated with the post
            $totalImagesCount = $post->images()->count(); // Count the images associated with the post

            if ($totalImagesCount + count($request->file('images')) > 4) {
                return response()->json(['message' => 'Maximum image limit exceeded'], 400);
            }
            

            if ($request->hasFile('images') && $userId && $post) {
                foreach ($request->file('images') as $imagefile) {
                    if ($imagefile->isValid()) {
                        $image = new Image;

                        $filenameWithExt = $imagefile->getClientOriginalName();
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension = $imagefile->getClientOriginalExtension();
                        $fileNameToStore = $filename.'_'.time().'.'.$extension;
                        $upload_path = 'post_images/';
                        $path_url = $upload_path . $fileNameToStore;

                        $success = $imagefile->move($upload_path, $fileNameToStore);

                        $image->image_url = $path_url;
                        $image->user_id = $userId;
                        $image->post_id = $post->id;
                        $image->save(); // Save the image record in the database

                        $uploadedImages[] = $image; // Add the uploaded image to the array
                    }
                }

                // Prepare the image URLs array for the response
                $imageUrls = [];
                foreach ($uploadedImages as $image) {
                    $imageUrls[] = asset($image->image_url);
                }

                return response()->json([
                    'message' => 'Images uploaded successfully',
                    'imageUrls' => $imageUrls,
                ]);
            } else {
                return response()->json(['message' => 'Invalid request'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage());

            return response()->json(['message' => 'Error uploading images'], 500);
        }

    }

    public function deletePostImage(Image $image)
    {      

        // Delete the image file from storage
        File::delete($image->path);

        // Delete the image record from the database
        $image->delete();

        // $alerted = Alert::success('Image Deleted', 'Your Image has been deleted'); 
        // return redirect()->back()->with('alerted');
        return response()->json(['message' => 'Image deleted successfully']);


    }

    public function delete(Post $post)
    {

        $post->delete();
        $alerted = Alert::success('Post Deleted', 'Your post has been deleted'); 
        return redirect()->back()->with('alerted');

    }
       
   

}
