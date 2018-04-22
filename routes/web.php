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
// test
Route::get('/', 'HomeController@getIndex');

Route::get('test', function(){
	return view('admin.layout.master');
});

Route::get('index.html', 'HomeController@getIndex');

Route::get('truyenmoi/{category_id}', 'StoryController@getNewestStory');

// end test

//admin
Route::group(['prefix'=>'admin'], function(){

	Route::get('/', function(){
		return redirect(route('admin.category.index'));
	});
	//Tac gia
    Route::group(['prefix' => 'tac-gia'], function () {
        Route::get('/', 'AuthorController@index')->name('admin.author.index');

        Route::get('/danhsach', 'AuthorController@getAll')->name('admin.author.list');

        Route::get('/{authorSlug}','AuthorController@getStoryView')->name('admin.author.story');

        Route::get('/truyen/{authorSlug}', 'AuthorController@getStoryByAuthorSlug')->name('admin.author.storyList');

        Route::post('/them', 'AuthorController@store')->name('admin.author.store');

        Route::post('/change-status','AuthorController@changeStatus')->name('admin.author.changeStatus');

        Route::put('/sua/{authorSlug}', 'AuthorController@update')->name('admin.author.update');

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

    //Truyện
    Route::group(['prefix' => 'truyen'], function() {
        Route::get('/', 'StoryController@index')->name('admin.story.index');

        Route::get('/danhsach', 'StoryController@getAll')->name('admin.story.list');

        Route::get('/{id}/danh-sach-chuong', 'StoryController@getChapterView')->name('admin.story.chapterView');

        Route::get('/{id}/danhsach', 'StoryController@getChaptersByStoryId')->name('admin.story.listChapter');

        Route::get('/{id}/chuong-moi-nhat','StoryController@getLastestChapterOrder')->name('admin.story.lastestChapterOrder');

        Route::get('/{id}/chitiet', 'StoryController@getDetail')->name('admin.story.detail');

        Route::post('/them', 'StoryController@store')->name('admin.story.store');

        Route::put('/sua/{storyId}', 'StoryController@update')->name('admin.story.update');

        Route::delete('/xoa', 'StoryController@delete')->name('admin.story.delete');

        Route::delete('/xoa-nhieu', 'StoryController@deleteMulti')->name('admin.story.deleteMulti');

        Route::post('/change-status', 'StoryController@changeStatus')->name('admin.truyen.changeStatus');

    });

    Route::group(['prefix' => 'chuong'], function() {
        Route::get('/{id}/chi-tiet', 'ChapterController@getDetail');

        Route::post('/them', 'ChapterController@store')->name('admin.chapter.store');

        Route::put('/{id}/sua', 'ChapterController@update')->name('admin.chapter.update');

        Route::delete('/xoa', 'ChapterController@delete')->name('admin.chapter.delete');

        Route::delete('/xoa-nhieu', 'ChapterController@deleteMulti')->name('admin.chapter.deleteMulti');
    });
});