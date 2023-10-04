<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
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
use App\Jobs\ReplicatePostJob;


class AutomatePostsController extends Controller
{
    public function replicatePost($postId)
    {
        // $postId = 1;
        ReplicatePostJob::dispatch($postId);
       

        // Redirect back to a relevant page after replication or show a success message
        return redirect()->back()->with('success', 'Post replicated in other cities');
    }
    
}