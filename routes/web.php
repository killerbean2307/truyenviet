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
Route::get('/', 'HomeController@getIndex')->name('index');

Route::get('test-search', 'HomeController@getSearch')->name('getSearch');

Route::get('truyen-hoan-thanh', 'HomeController@getFullStoryList')->name('full-story');

Route::get('truyen-moi', 'HomeController@getLastUpdatedStory')->name('new-story');

Route::get('truyen-hot', 'HomeController@getHotStoryList')->name('hot-story');

Route::get('truyen-doc-nhieu', 'HomeController@getMostViewStory')->name('most-view-story');

Route::get('truyen-dang-doc', 'HomeController@getReadingStory')->name('reading');

Route::post('doc-chuong', 'HomeController@goToChapter')->name('doc-chuong');

Route::get('tim-kiem', 'HomeController@search')->name('search');

Route::group(['prefix' => '/the-loai'], function(){
    Route::get('/{categorySlug}', 'HomeController@getCategoryStory')->name('category.story');
});

Route::group(['prefix' => '/tac-gia'], function(){
    Route::get('/{authorSlug}', 'HomeController@getStoryViewByAuthor')->name('author.story');
});

Route::group(['prefix' => '/truyen'], function(){
    Route::get('/like', 'HomeController@like')->name('like');

    Route::get('/{storySlug}', 'HomeController@getStoryView')->name('story');

    Route::get('/{storySlug}/chuong-{ordering}', 'HomeController@getChapterView')->name('chapter')->where('ordering','[0-9]+')->middleware('viewFilter');
});


Route::get('login', 'HomeController@getLogin')->name('login');
Route::post('login', 'HomeController@postLogin')->name('post.login');
Route::get('logout','HomeController@getLogout')->name('logout');
Route::get('refreshSession', 'HomeController@refreshSession')->name('refreshSession');
//admin
Route::group(['prefix'=>'admin','middleware' => 'auth'], function(){

	Route::get('/', 'HomeController@getDashboard')->name('admin.dashboard');
	//Tac gia
    Route::group(['prefix' => 'tac-gia'], function () {
        Route::get('/', 'AuthorController@index')->name('admin.author.index');

        Route::get('/danhsach', 'AuthorController@getAll')->name('admin.author.list');

        Route::get('/{authorSlug}','AuthorController@getStoryView')->name('admin.author.story');

        Route::get('/truyen/{authorSlug}', 'AuthorController@getStoryByAuthorSlug')->name('admin.author.storyList');

        Route::post('/them', 'AuthorController@store')->name('admin.author.store');

        Route::post('/change-status','AuthorController@changeStatus')->name('admin.author.changeStatus')->middleware('admin');

        Route::put('/sua/{authorSlug}', 'AuthorController@update')->name('admin.author.update')->middleware('admin');

        Route::delete('/xoa', 'AuthorController@delete')->name('admin.author.delete')->middleware('admin');

        Route::delete('/xoa-nhieu', 'AuthorController@deleteMulti')->name('admin.author.deleteMulti')->middleware('admin');

    });
    
	//Thể loại
    Route::group(['prefix' => 'the-loai'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.category.index');

        Route::post('/danhsach', 'CategoryController@getAll')->name('admin.category.list');

        Route::get('/{categorySlug}','CategoryController@getStoryView')->name('admin.category.story');

        Route::get('/truyen/{categorySlug}', 'CategoryController@getStoryByCategorySlug')->name('admin.category.storyList');

        Route::post('/them', 'CategoryController@store')->name('admin.category.store')->middleware('admin');

        Route::post('/change-status','CategoryController@changeStatus')->name('admin.category.changeStatus')->middleware('admin');

        Route::put('/sua/{categorySlug}', 'CategoryController@update')->name('admin.category.update')->middleware('admin');

        Route::delete('/xoa', 'CategoryController@delete')->name('admin.category.delete')->middleware('admin');

        Route::delete('/xoa-nhieu', 'CategoryController@deleteMulti')->name('admin.category.deleteMulti')->middleware('admin');

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

        Route::delete('/xoa', 'StoryController@delete')->name('admin.story.delete')->middleware('admin');

        Route::delete('/xoa-nhieu', 'StoryController@deleteMulti')->name('admin.story.deleteMulti')->middleware('admin');

        Route::post('/change-status', 'StoryController@changeStatus')->name('admin.truyen.changeStatus')->middleware('admin');

    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'UserController@index')->name('admin.user.index');

        Route::get('/danhsach', 'UserController@getAll')->name('admin.user.list');

        Route::get('/{userId}', 'UserController@getDetail')->name('admin.user.detail');

        Route::post('/them', 'UserController@store')->name('admin.user.store')->middleware('admin');

        Route::put('/sua/{userId}', 'UserController@update')->name('admin.user.update')->middleware('admin');

        Route::delete('/xoa', 'UserController@delete')->name('admin.user.delete')->middleware('admin');

        Route::delete('/xoa-nhieu', 'UserController@deleteMulti')->name('admin.user.delete')->middleware('admin');

        Route::post('/change-status', 'UserController@changeStatus')->name('admin.user.changeStatus')->middleware('admin');

    });

    Route::group(['prefix' => 'chuong'], function() {
        Route::get('/{id}/chi-tiet', 'ChapterController@getDetail');

        Route::post('/them', 'ChapterController@store')->name('admin.chapter.store');

        Route::put('/{id}/sua', 'ChapterController@update')->name('admin.chapter.update');

        Route::delete('/xoa', 'ChapterController@delete')->name('admin.chapter.delete');

        Route::delete('/xoa-nhieu', 'ChapterController@deleteMulti')->name('admin.chapter.deleteMulti');
    });
});