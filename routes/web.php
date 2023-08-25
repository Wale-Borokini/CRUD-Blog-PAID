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
    Route::get('/edit-country/{country:slug}', [CountriesController::class, 'editCountry'])->name('edit-country');
    Route::put('/update-country/{country:slug}',[CountriesController::class, 'updateCountry'])->name('country.update');
    Route::delete('/delete-country/{country:slug}',[CountriesController::class, 'destroyCountry'])->name('country.delete');

    Route::resource('states', StatesController::class);
    Route::get('/edit-state/{state:slug}', [StatesController::class, 'editState'])->name('edit-state');
    Route::put('/update-state/{state:slug}',[StatesController::class, 'updateState'])->name('state.update');
    Route::delete('/deleteState/{state:slug}',[StatesController::class, 'destroyState'])->name('state.delete');

    Route::resource('cities', CitiesController::class);
    // Route::get('/edit-city/{city:slug}', [CitiesController::class, 'editCity'])->name('edit-city');
    // Route::put('/update-city/{city:slug}',[CitiesController::class, 'updateCity'])->name('city.update');
    // Route::delete('/delete-city/{city:slug}',[CitiesController::class, 'destroyCity'])->name('city.delete');

    Route::resource('genders', GendersController::class);
    // Route::get('/edit-gender/{gender:slug}', [GendersController::class, 'editGender'])->name('edit-gender');
    // Route::put('/update-gender/{gender:slug}',[GendersController::class, 'updateGender'])->name('gender.update');
    // Route::delete('/delete-gender/{gender:slug}',[GendersController::class, 'destroyGender'])->name('gender.delete');

    Route::resource('ethnicities', EthnicitiesController::class);
    Route::get('/edit-ethnicity/{ethnicity:slug}', [EthnicitiesController::class, 'editEthnicity'])->name('edit-ethnicity');
    Route::put('/update-ethnicity/{ethnicity:slug}',[EthnicitiesController::class, 'updateEthnicity'])->name('ethnicity.update');
    Route::delete('/delete-ethnicity/{ethnicity:slug}',[EthnicitiesController::class, 'destroyEthnicity'])->name('ethnicity.delete');

    Route::resource('hairs', HairsController::class);
    Route::resource('eyes', EyesController::class);
    Route::resource('plans', PlansController::class);

    Route::get('/admin-dashboard', [AdminController::class, 'viewAdminDashboardPage'])->name('admin-dashboard');
    Route::get('/add-locations', [AdminController::class, 'viewAddLocationsPage'])->name('add-locations');
    Route::get('/personal-attributes', [AdminController::class, 'viewpersonalAttributesPage'])->name('personal-attributes');

});




Auth::routes();

// Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('profile');

