<?php

use App\Http\Controllers\BackEndController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostCountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
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


Route::get('/', [FrontendController::class, 'index'])->name('front.index');
Route::get('/all-post', [FrontendController::class, 'all_post'])->name('front.all_post');
Route::get('/search', [FrontendController::class, 'search'])->name('front.search');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('front.category');
Route::get('/category/{cat_slug}/{sub_cat_slug}', [FrontendController::class, 'sub_category'])->name('front.sub_category');
Route::get('/tag/{slug}', [FrontendController::class, 'tag'])->name('front.tag');
Route::get('/single-post/{slug}', [FrontendController::class, 'single'])->name('front.single');
Route::get('/contact-us', [FrontendController::class, 'contact_us'])->name('front.contact');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
Route::get('/get-districts/{division_id}', [ProfileController::class, 'getDistricts']);
Route::get('/get-thanas/{district_id}', [ProfileController::class, 'getThanas']);
Route::get('/get-unions/{thana_id}', [ProfileController::class, 'getUnions']);
Route::get('/post-count/{post_id}', [FrontendController::class, 'postReadCount']);

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){
    Route::get('', [BackEndController::class, 'index'])->name('back.index');
    Route::resource('post', PostController::class);
    Route::get('get-subcategory/{id}', [SubCategoryController::class, 'getSubCategorByCategoryId']);
    Route::resource('comment', CommentController::class);
    Route::post('upload-photo', [ProfileController::class, 'upload_photo']);
    Route::resource('profile', ProfileController::class);

    Route::middleware(['admin'])->group(function () {
        Route::resource('category', CategoryController::class);
        Route::resource('tag', TagController::class);
        Route::resource('sub-category', SubCategoryController::class);
    });




});

require __DIR__ . '/auth.php';
