<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\EthnicitiesController;
use App\Http\Controllers\HairsController;
use App\Http\Controllers\EyesController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\FetchLocationsController;
use App\Http\Controllers\AdminController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/welcome', function () {
//     return view('welcome');
// });






//Show posts in cities
Route::get('/city/{city}', [CitiesController::class, 'showPosts'])->name('city.show-posts');
Route::get('/post-details/{slug}', [CitiesController::class, 'viewPostDetails'])->name('post-details');


Route::get('/', [PagesController::class, 'viewIndexPage'])->name('index');

Route::get('/view-states', [PagesController::class, 'viewStatesPage'])->name('view-states');



/////////////////Admin



/////////////Posts

//Route::get('/viewPosts', [PostsController::class, 'viewPostsPage'])->name('viewPosts');


// Route::get('/profileDetails/{slug}', [PostsController::class, 'viewProfileDetailsPage'])->name('profileDetails');

//Route::get('/post/{slug}', [PostsController::class, 'show'])->name('post.show');



Route::group([ 'middleware' => ['auth']], function() {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/buy-credits-code', [ProfileController::class, 'viewBuyCreditsCodePage'])->name('buy-credits-code');
    Route::get('/buy-credits', [ProfileController::class, 'viewBuyCreditsPage'])->name('buy-credits');

    // Fetch locations for dynamic dropdown
    Route::get('/get-states/{country_id}', [FetchLocationsController::class, 'getStateByCountry']);
    Route::get('/get-cities/{state_id}', [FetchLocationsController::class, 'getCitiesByState']);



    Route::get('/create-post', [PostsController::class, 'viewCreatePostPage'])->name('create-post');
    Route::post('/create-post', [PostsController::class, 'createPost'])->name('create.post');

    
               
});


Route::middleware(['auth', 'admin'])->group(function () {
    // Admin middleware
    Route::resource('countries', CountriesController::class);   
    Route::resource('states', StatesController::class);    
    Route::resource('cities', CitiesController::class);    
    Route::resource('genders', GendersController::class);
    Route::resource('ethnicities', EthnicitiesController::class);
    Route::resource('hairs', HairsController::class);
    Route::resource('eyes', EyesController::class);
    
    Route::resource('plans', PlansController::class);

    Route::get('/admin-dashboard', [AdminController::class, 'viewAdminDashboardPage'])->name('admin-dashboard');
    Route::get('/add-locations', [AdminController::class, 'viewAddLocationsPage'])->name('add-locations');
    Route::get('/personal-attributes', [AdminController::class, 'viewPersonalAttributesPage'])->name('personal-attributes');
    Route::get('/transaction-menu', [AdminController::class, 'viewTransactionMenuPage'])->name('transaction-menu');

});




Auth::routes();

// Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('profile');

