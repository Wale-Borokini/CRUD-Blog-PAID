<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Purifier;
use Illuminate\Support\Str;
use Auth;
use DB;
Use Alert;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;


class ImagesController extends Controller
{
    public function addDeletePostImage(Post $post)
    {
        $this->authorize('update-post', $post);
       
        $title = 'Add/Delete Image';       
        
        return view('pages.add-delete-post-image')->with(compact('post'));

    }

    public function uploadImageEdit(Request $request)
    {   
        $rules = [            
            'image_url.*' => 'image|mimes:jpeg,png,jpg,gif,heif,webp|max:15048', 
        ];
    
        $messages = [
            'image_url.*.image' => 'Uploaded file is not an image.',
            'image_url.*.mimes' => 'Only JPEG, PNG, Webp, and GIF files are allowed.',
            'image_url.*.max' => 'Image size should not exceed 15MB.',
        ];
    
        $validator = Validator::make($request->only('image_url'), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }                  

        try {
            $uploadedImages = [];
            $userId = Auth::user()->id;
            $postSlug = $request->post_slug; // Get the post slug from the request

            // Retrieve the Post model based on the post slug
            $post = Post::where('slug', $postSlug)->first();

            if (!$post) {
                return response()->json(['message' => 'Post not found'], 404);
            }

            if ((int)$userId !== (int)$post->user_id) {
                return response()->json(['message' => 'Unauthorized'], 401);
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
                        $randSlug = Str::random(50);                                                
                        $fileNameToStore = "{$randSlug}_" . time() . ".{$extension}";                      
                        $storageDirectory = 'public/images/post_images';                    
                        $path_url = $imagefile->storeAs($storageDirectory, $fileNameToStore);                        
                        $completeUrl = Storage::url($path_url);

                        $image->image_url = $completeUrl;
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
        $this->authorize('delete-image', $image);

       // Delete the image file from storage
       $this->deleteImageFromStorage($image->image_url);

       // Delete the image record from the database
       $image->delete();

       $alerted = Alert::success('Image Deleted', 'Your Image has been deleted');
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
