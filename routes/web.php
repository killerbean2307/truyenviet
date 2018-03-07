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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function(){
	return view('admin.layout.master');
});

Route::group(['prefix'=>'admin'], function(){

	Route::get('/', function(){
		return redirect(route('admin.category.index'));
	});
	//Tac gia
    Route::group(['prefix' => 'tac-gia'], function (){
        Route::get('/', 'AuthorController@getList')->name('admin.author.list');

        // Route::get('/tac-gia/them', 'AuthorController@create')->name('admin.author.new');

        Route::post('/them', 'AuthorController@store')->name('admin.author.store');

        Route::get('/sua/{id}', 'AuthorController@edit')->name('admin.author.edit');

        Route::put('/sua/{id}', 'AuthorController@update')->name('admin.author.update');

        Route::delete('/xoa', 'AuthorController@delete')->name('admin.author.delete');

        Route::delete('/xoa-nhieu', 'AuthorController@deleteMulti')->name('admin.author.deleteMulti');
    });
    
	//Thể loại
    Route::group(['prefix' => 'the-loai'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.category.index');

        Route::post('/danhsach', 'CategoryController@getAll')->name('admin.category.list');

        Route::get('/{categorySlug}','CategoryController@getStoryView')->name('admin.category.story');

        Route::get('/truyen/{categorySlug}', 'CategoryController@getStoryByCategorySlug')->name('admin.category.storyList');

        Route::post('/them', 'CategoryController@store')->name('admin.category.store');

        Route::post('/change-status','CategoryController@changeStatus')->name('admin.category.changeStatus');

        Route::put('/sua/{categorySlug}', 'CategoryController@update')->name('admin.category.update');

        Route::delete('/xoa', 'CategoryController@delete')->name('admin.category.delete');

        Route::delete('/xoa-nhieu', 'CategoryController@deleteMulti')->name('admin.category.deleteMulti');

    });
});
