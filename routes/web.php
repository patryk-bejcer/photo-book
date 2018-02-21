<?php

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

use Intervention\Image\Facades\Image;

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

/* Admin routes */
Route::get('admin', function () { return view('dashboard'); })->middleware('isAdmin');
Route::resource('admin/users', 'UsersBackendController');
Route::resource('admin/roles', 'RolesController');
Route::resource('admin/permissions', 'PermissionsController');

/* User routes */
Route::resource('users','UsersController');
Route::resource('images','ImagesController');

Route::get('users/{user}/images','UsersController@userImages')->name('user-images');
Route::get('users/{user}/albums','UsersController@userAlbums')->name('user-albums');

Route::get('users/{user}/images/upload','ImagesController@create');
Route::post('users/{user}/images/upload','ImagesController@store');

Route::get('users/{user}/albums/{album}/','AlbumsController@show')->where('album', '[0-9]+');
Route::get('users/{user}/albums/{album}/edit','AlbumsController@edit')->where('album', '[0-9]+');

Route::get('users/{user}/albums/create','AlbumsController@create');
Route::post('users/{user}/albums/create','AlbumsController@store');

Route::post('comment-image/{image}','CommentsController@store');

Route::get('all-comments','CommentsController@index');
Route::delete('all-comments/{comment}','CommentsController@destroy');


Route::get('/home', 'HomeController@index')->name('home');
Route::resource('images','ImagesController');
Route::get('/test', function()
{
	$imgPath = asset('img/foo.jpg');

	$img = Image::make($imgPath)->resize(300, 200);

	return $img->response('jpg');
});

