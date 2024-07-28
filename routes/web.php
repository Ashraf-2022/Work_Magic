<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\posts\PostsController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Admins\AdminsController;
use App\Http\Controllers\Users\UserController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\posts\PostsController::class, 'index'])->name('welcome');
Route::get('/home', [App\Http\Controllers\posts\PostsController::class, 'index'])->name('home');
Route::get('/Contact-Us', [App\Http\Controllers\posts\PostsController::class, 'Contact'])->name('contact');
Route::get('/About-Us', [App\Http\Controllers\posts\PostsController::class, 'About'])->name('About');




Route::group(['Grouping' => 'posts'], function () {
    Route::get('/index', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/posts/show/{id}', [PostsController::class, 'show'])->name('posts.show');
    Route::post('/posts/comments', [PostsController::class, 'store'])->name('comments.store');
    Route::get('/posts/Create-Post', [PostsController::class, 'CreatePost'])->name('posts.create');
    Route::post('/posts/PostStore', [PostsController::class, 'StorePost'])->name('posts.store');
    Route::get('/posts/delete/{id}', [PostsController::class, 'destroy'])->name('posts.delete');

    // Routes Update Methods
    Route::get('/posts/Edit-Post/{id}', [PostsController::class, 'Edit'])->name('posts.edit');
    Route::put('/posts/Update-Post/{id}', [PostsController::class, 'update'])->name('posts.Update');

    // search
    Route::any('/posts/search', [PostsController::class, 'search'])->name('posts.search');
});

Route::group(['prefix' => 'categories'], function () {

    Route::get('/Category/{category}', [CategoryController::class, 'category'])->name('category.single');
});
Route::group(['prefix' => 'users'], function () {

    Route::get('/Edit-Profile/{id}', [UserController::class, 'EditProfile'])->name('users.Edit-profile');
    Route::any('/Update-Profile/{id}', [UserController::class, 'UpdateProfile'])->name('users.update-profile');
    Route::get('/User-Profile/{id}', [UserController::class, 'Profile'])->name('users.profile');
});



// certificate routes
Route::any('/certificates/upload', [UserController::class, 'uploadCertificate'])->name('certificates.upload');



// Admin routes

Route::get('Admin/Login', [AdminsController::class, 'ViewAdmin'])->name('admin.login')->middleware('CheckAuth');
Route::post('Admin/Login-check', [AdminsController::class, 'checkAdmin'])->name('admin.check-login');
Route::group(['prefix' => 'Admin', 'middleware' => 'auth:admins'], function () {
    Route::any('/', [AdminsController::class, 'index'])->name('admin.dashboard');
});
Route::group(['prefix' => 'Admin'], function () {
    Route::get('/show', [AdminsController::class, 'GetAdmins'])->name('admin.show');
    Route::any('/Create', [AdminsController::class, 'CreateAdmin'])->name('admin.create');
    Route::post('/AdminStore', [AdminsController::class, 'StoreAdmin'])->name('admin.store');

    // category admin
    Route::any('/Show-Categories', [AdminsController::class, 'showcategory'])->name('category.show');
    Route::any('/Create-Category', [AdminsController::class, 'Createcategory'])->name('category.create');
    Route::post('/Store-Category', [AdminsController::class, 'StoreCategory'])->name('category.store');

    // delete category admin
    Route::get('/delete/{id}', [AdminsController::class, 'destroy'])->name('category.delete');

    // update category admin
    Route::get('/Update-Category/{id}', [AdminsController::class, 'UpdateCategory'])->name('Admin.UpdateCategory');
    Route::any('/Edit-Catefory/{id}', [AdminsController::class, 'Editing'])->name('admin.editcategory');

    // show Admin Posts
    Route::get('/Admin-Posts', [AdminsController::class, 'ShowPosts'])->name('Admin.posts.show-posts');
    Route::get('/Admin-Posts/delete/{id}', [AdminsController::class, 'DeletePost'])->name('Admin.posts.delete');
});
