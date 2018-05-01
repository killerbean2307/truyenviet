<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Story;
use App\Author;
use App\Chapter;
use App\User;
use App\ViewCount;
use Charts;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

class HomeController extends Controller
{
	function __construct()
	{
		$categories = Category::orderBy('name', 'asc')->get();
		view()->share('categories',$categories);
	}
	
    public function getIndex()
    {	
		$newestChapters = Chapter::getNewestChapter()->take(10);
		$fullStories = Story::getFullStory()->take(10);
		$hotStories = Story::getHotStory()->take(10);
		// return response()->json($hotStories);
    	return view('index', compact('newestChapters','fullStories','hotStories'));
	}

	public function getCategoryStory($categorySlug)
	{
		$category = Category::findBySlugOrFail($categorySlug);
		$listStories = $category->story()->has('chapter')->paginate(20);
		$title = 'Truyện '.$category->name;
		$slug = $category->slug;
		$is_category = true;
		return view('list_story', compact('listStories','title','slug','is_category'));
	}

	public function getStoryView($storySlug)
	{
		$story = Story::findBySlugOrFail($storySlug);
		$topLastedChapter = $story->chapter()->orderBy('ordering','desc')->limit(5)->get();
		$chapters = $story->chapter()->paginate(50);
		return view('story', compact('story','topLastedChapter','chapters'));
	}

	public function getChapterView($storySlug, $ordering)
	{
		echo $storySlug."".$ordering;
	}

	public function getDashboard()
	{
		$chap = Chapter::whereYear('created_at', date('Y'))->get();
		$chart = Charts::database($chap,'bar','morris')
					->title(false)
					->elementLabel('Chương mới')
					->dimensions(1000, 500)
					->responsive(true)
					->lastByDay(30,false);

		$storyCount = Story::count();
		$chapterCount = Chapter::count();
		$authorCount = Author::count();
		$totalStoryView = Story::sum('view');
		return view('admin.dashboard', compact('chart','storyCount', 'chapterCount','authorCount','totalStoryView'));
	}
}
