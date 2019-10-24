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


Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('posts/find/{id}', 'Admin\PostsController@find')->name('posts.find');
    Route::get('posts/list', 'Admin\PostsController@list')->name('posts.list');
    Route::any('posts/quickUpdate/{post}', 'Admin\PostsController@quickUpdate')->name('posts.quickUpdate');
    Route::resource('posts', 'Admin\PostsController');
    Route::get('categories/find/{id}', 'Admin\CategoriesController@find')->name('categories.find');
    Route::post('categories/updateAjax/{id}', 'Admin\CategoriesController@updateAjax')->name('categories.updateAjax');
    Route::get('categories/listCategoryDataTables', 'Admin\CategoriesController@listCategoryDataTables')->name('categories.listCategoryDataTables');
    Route::resource('categories', 'Admin\CategoriesController');

});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/posts/{id}', 'HomeController@show')->name('showPost');
Route::get('/listCategory', 'HomeController@listCategory')->name('listCategory');
Route::get('/listCategoryDataTables', 'HomeController@listCategoryDataTables')->name('listCategoryDataTables');
Route::get('/listPost', 'HomeController@list')->name('posts.list');
