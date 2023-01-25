<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\Frontend\HomeController@index')->name('home.frontend');
// Route::resource('/reads', 'App\Http\Controllers\Frontend\NewsController', ['except' => ['destroy','update','create','store']]);
Route::get('/reads', 'App\Http\Controllers\Frontend\NewsController@index')->name('reads.index');
Route::get('/reads/{slug}', 'App\Http\Controllers\Frontend\NewsController@show')->name('reads.show');
Route::get('/reads/bycategory/{category}', 'App\Http\Controllers\Frontend\NewsController@listByCategory')->name('reads.category');
Route::get('/reads/bytags/{tag}', 'App\Http\Controllers\Frontend\NewsController@listByTags')->name('reads.tag');
Route::get('/reads/search', 'App\Http\Controllers\Frontend\NewsController@searchNews')->name('reads.search');
Route::post('/comment/store', 'App\Http\Controllers\Frontend\CommentController@store')->name('comment.post');
Route::post('/reply/store', 'App\Http\Controllers\Frontend\CommentController@replyStore')->name('reply.post');

Auth::routes();
Route::middleware(['auth','permission:0,1,2'])->group(function (){
  Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
  // User
  Route::resource('users', 'App\Http\Controllers\Backend\UserController', ['except' => ['show']])->middleware('permission:0,1');
  Route::get('trashdata/user', 'App\Http\Controllers\Backend\UserController@trashData')->name('trash.user')->middleware('permission:0');
  Route::delete('trashdata/user/forcedelete/{id}', 'App\Http\Controllers\Backend\UserController@forceDelete')->middleware('permission:0');
  Route::get('trashdata/user/restore/{id}', 'App\Http\Controllers\Backend\UserController@restore')->name('restore.user')->middleware('permission:0');
  Route::get('trashdata/user/restore-all', 'App\Http\Controllers\Backend\UserController@restoreAll')->name('restoreall.user')->middleware('permission:0');
  // News
  Route::resource('news', 'App\Http\Controllers\Backend\NewsController', ['except' => ['show']]);
  Route::get('/tags/suggest', 'App\Http\Controllers\Backend\NewsController@tagsSuggest')->name('tags.suggest');
  Route::get('trashdata/news', 'App\Http\Controllers\Backend\NewsController@trashData')->name('trash.news')->middleware('permission:0');
  Route::delete('trashdata/news/forcedelete/{id}', 'App\Http\Controllers\Backend\NewsController@forceDelete')->middleware('permission:0');
  Route::get('trashdata/news/restore/{id}', 'App\Http\Controllers\Backend\NewsController@restore')->name('restore.news')->middleware('permission:0');
  Route::get('trashdata/news/restore-all', 'App\Http\Controllers\Backend\NewsController@restoreAll')->name('restoreall.news')->middleware('permission:0');
  // Profile
  Route::get('/profile/edit/{id}', 'App\Http\Controllers\Backend\ProfileController@edit')->name('profile.edit');
  Route::put('/profile/update', 'App\Http\Controllers\Backend\ProfileController@update')->name('profile.update');
  Route::put('/profile/password', 'App\Http\Controllers\Backend\ProfileController@password')->name('profile.password');
  // Category
  Route::resource('category', 'App\Http\Controllers\Backend\CategoryController', ['except' => ['show']])->middleware('permission:0,1');
  Route::get('trashdata/category', 'App\Http\Controllers\Backend\CategoryController@trashData')->name('trash.category')->middleware('permission:0');
  Route::delete('trashdata/category/forcedelete/{id}', 'App\Http\Controllers\Backend\CategoryController@forceDelete')->middleware('permission:0');
  Route::get('trashdata/category/restore/{id}', 'App\Http\Controllers\Backend\CategoryController@restore')->name('restore.category')->middleware('permission:0');
  Route::get('trashdata/category/restore-all', 'App\Http\Controllers\Backend\CategoryController@restoreAll')->name('restoreall.category')->middleware('permission:0');
  // Tags
  Route::resource('tags', 'App\Http\Controllers\Backend\TagController', ['except' => ['show']])->middleware('permission:0,1');
  // Comment
  Route::resource('comments', 'App\Http\Controllers\Backend\CommentController', ['except' => ['show']])->middleware('permission:0,1');


  
});
