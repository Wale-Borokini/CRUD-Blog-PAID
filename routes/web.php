<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\EthnicitiesController;
use App\Http\Controllers\HairsController;
use App\Http\Controllers\EyesController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\WalletadressController;
use App\Http\Controllers\AdvertsController;
use App\Http\Controllers\FetchLocationsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AutomatePostsController;

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

//Show posts in cities
Route::get('/', [PagesController::class, 'viewIndexPage'])->name('index');
Route::get('/contact', [ContactController::class, 'viewContactPage'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendContactForm'])->name('contact.submit');
Route::get('/privacy', [PagesController::class, 'viewPrivacyPage'])->name('privacy');
Route::get('/terms', [PagesController::class, 'viewTermsPage'])->name('terms');
Route::get('/report-case', [PagesController::class, 'viewReportCasePage'])->name('report-case');

Route::get('/city/{city:slug}', [CitiesController::class, 'showPosts'])->name('city.show-posts');
Route::get('/post-details/{slug}', [CitiesController::class, 'viewPostDetails'])->name('post-details');

// Authenticated Users
Route::group([ 'middleware' => ['auth', 'verified']], function() {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/buy-credits-code', [ProfileController::class, 'viewBuyCreditsCodePage'])->name('buy-credits-code');
    Route::get('/buy-credits', [ProfileController::class, 'viewBuyCreditsPage'])->name('buy-credits');

    // Fetch locations for dynamic dropdown
    Route::get('/get-states/{country_id}', [FetchLocationsController::class, 'getStateByCountry']);
    Route::get('/get-cities/{state_id}', [FetchLocationsController::class, 'getCitiesByState']);

    Route::get('/create-post', [PostsController::class, 'viewCreatePostPage'])->name('create-post');
    Route::post('/create-post', [PostsController::class, 'createPost'])->name('create.post');

    Route::get('/edit-post/{post:slug}', [PostsController::class, 'edit'])->name('post.edit');
    Route::put('/edit-post/{post:slug}', [PostsController::class, 'update'])->name('post.update');
    Route::delete('/delete-post/{post:slug}', [PostsController::class, 'delete'])->name('post.delete');

    Route::get('/add-delete-post-image/{post:slug}', [ImagesController::class, 'addDeletePostImage'])->name('add-delete-post-image');
    Route::post('/upload-image-edit', [ImagesController::class, 'uploadImageEdit'])->name('upload-image-edit');
    Route::delete('/delete-post-image/{image:slug}', [ImagesController::class, 'deletePostImage'])->name('delete-post-image');    

    Route::post('/log-page-visit', [AdminController::class, 'logPageVisit'])->name('log-page-visit');
    Route::get('/buy-credits-page-log', [AdminController::class, 'viewBuyCreditsPageLogs'])->name('buy-credits-page-log');
                   
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
    Route::resource('adverts', AdvertsController::class);    

    Route::get('/admin-dashboard', [AdminController::class, 'viewAdminDashboardPage'])->name('admin-dashboard');
    //All Users
    Route::get('/all-users', [AdminController::class, 'viewAllUsersPage'])->name('all-users');   
    Route::get('/users-posts/{user:slug}', [AdminController::class, 'viewUsersPosts'])->name('users-posts');    
    //Search
    Route::get('/search-users', [SearchController::class, 'searchUsers'])->name('search-users');
    Route::get('/search-users-roles', [SearchController::class, 'searchUsersRoles'])->name('search-users-roles');
    Route::get('/credit-users-search', [SearchController::class, 'creditUsersSearch'])->name('credit-users-search');
    Route::get('/debit-users-search', [SearchController::class, 'debitUsersSearch'])->name('debit-users-search');
    Route::get('/search-transactions', [SearchController::class, 'searchTransactions'])->name('search-transactions');
    Route::get('/search-page-logs', [SearchController::class, 'searchPageLogs'])->name('search-page-logs');
    Route::get('/search-posts', [SearchController::class, 'searchPosts'])->name('search-posts');


    //All Posts
    Route::get('/all-posts', [AdminController::class, 'viewAllPosts'])->name('all-posts');
    Route::get('/user-details/{user:slug}', [AdminController::class, 'viewUserDetailsPage'])->name('user-details');
    //Credit Users
    Route::get('/credit-user', [TransactionsController::class, 'viewCreditUserPage'])->name('credit-user');    
    Route::get('/credit-user-cash/{user:slug}', [TransactionsController::class, 'creditUserCashPage'])->name('credit.cash');
    Route::post('credit-user-cash/{user:slug}', [TransactionsController::class, 'creditUserTransaction'])->name('admin.credit.user');
    // Debit Users
    Route::get('/debit-user', [TransactionsController::class, 'viewDebitUserPage'])->name('debit-user');    
    Route::get('/debit-user-cash/{user:slug}', [TransactionsController::class, 'debitUserCashPage'])->name('debit.cash');
    Route::post('debit-user-cash/{user:slug}', [TransactionsController::class, 'debitUserTransaction'])->name('admin.debit.user');

    Route::get('/transaction-history', [TransactionsController::class, 'viewTransactionHistoryPage'])->name('transaction-history');
    Route::resource('transactions', TransactionsController::class);

    Route::get('/add-locations', [AdminController::class, 'viewAddLocationsPage'])->name('add-locations');
    Route::get('/personal-attributes', [AdminController::class, 'viewPersonalAttributesPage'])->name('personal-attributes');
    Route::get('/transaction-menu', [AdminController::class, 'viewTransactionMenuPage'])->name('transaction-menu'); 
    
    Route::get('/replicate-post/{postId}', [AutomatePostsController::class, 'replicatePost'])->name('replicate-post'); 

    Route::get('/delete-posts-new', [AutomatePostsController::class, 'deletePostsNew'])->name('delete-posts-new');

});


Route::middleware(['auth', 'super.admin'])->group(function () {

    Route::get('/admin-roles', [AdminController::class, 'viewAdminRoles'])->name('admin-roles');
    Route::put('/update-admin-role/{user:slug}', [AdminController::class, 'updateAdminRole'])->name('update-admin-role');

    Route::resource('wallets', WalletadressController::class);

});

// Auth::routes();
Auth::routes(['verify' => true]);