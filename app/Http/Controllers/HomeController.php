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
use App\Events\ChapterView;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	function __construct()
	{
		$categories = Category::orderBy('name', 'asc')->get();
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
		view()->share(['categories' => $categories, 'chart' => $chart, 'storyCount' => $storyCount, 'chapterCount' => $chapterCount, 'authorCount' => $authorCount, 'totalStoryView' => $totalStoryView]);
	}
	
	public function refreshSession()
	{
		return response([
		    'sessionData' => session()->all()
		]);
	}

    public function getIndex()
    {	
		$newestChapters = Chapter::getNewestChapter()->take(10);
		$fullStories = Story::getFullStory()->take(10);
		$hotStories = Story::getHotStory()->take(10);
		// return response()->json($hotStories);
    	return view('index', compact('newestChapters','fullStories','hotStories'));
	}

	public function goToChapter(Request $request)
	{
		$ordering = $request->input('ordering');
	    $storySlug = $request->input('story_slug');
	    $last = Story::findBySlugOrFail($storySlug)->getLastChapter()->ordering;
	    $first = Story::findBySlugOrFail($storySlug)->getFirstChapter()->ordering;
	    $chap = Chapter::whereHas('story', function($query) use ($storySlug) {
	    	$query->where('slug', $storySlug);
	    })->get()->pluck('ordering');

	  	if($ordering != null and $chap->contains($ordering))
	  	{
		    if($ordering > $last)
		    	$ordering = $last;
		    if($ordering <= 0)
		    	$ordering = $first;

	    	return redirect()->route('chapter',array($storySlug,$ordering));
		}

		return back();
	}

	public function getCategoryStory($categorySlug)
	{
		$category = Category::findBySlugOrFail($categorySlug);
		$listStories = $category->story()->has('chapter')->paginate(10);
		$title = 'Thể loại '.$category->name;
		$slug = $category->slug;
		$list = 1;
		return view('list_story', compact('listStories','title','slug','list'));
	}

	public function getFullStoryList()
	{
		$listStories = Story::has('chapter')->where('status',2)->orderBy('view','desc')->paginate(10);
		$title = "Truyện Hoàn Thành";
		$slug = "truyen-hoan-thanh";
		$list = 0;

		return view('list_story', compact('listStories','title','slug','list'));
	}

	public function getHotStoryList()
	{
		$listStories = Story::leftJoin('view_count', 'story.id', 'view_count.story_id')->has('chapter')
                    ->orderBy('view_count.week_view','desc')->paginate(10);
		$title = "Truyện Hot";
		$slug = "truyen-hot";
		$list = 0;

		return view('list_story', compact('listStories','title','slug','list'));
	}

	public function getLastUpdatedStory()
	{
		$listStories = Story::join('chapter', 'story.id','=','chapter.story_id')->orderBy('chapter.created_at','desc')->select('story.*')->get()->unique();

		$title = "Truyện Mới Cập Nhật";
		$slug = "truyen-moi";
		$list = 0;

		$listStories = $this->paginate($listStories,10);

		return view('list_story', compact('listStories','title','slug','list'));
	}	

	public function getStoryViewByAuthor($authorSlug)
	{
		$author = Author::findBySlugOrFail($authorSlug);
		$listStories = $author->story()->has('chapter')->paginate(10);
		$title = "Tác giả ".$author->name;
		$list = 2;
		$slug = $author->slug;
		
		return view('list_story', compact('listStories', 'title', 'slug', 'list'));
	}

	public function getStoryView($storySlug)
	{
		$story = Story::findBySlugOrFail($storySlug);
		$relateStories = Story::inRandomOrder()->where('category_id', $story->category_id)->where('id',"<>",$story->id)->take(5)->get()->sortByDesc('view');
		$topLastedChapter = $story->chapter()->orderBy('ordering','desc')->limit(5)->get();
		$chapters = $story->chapter()->orderBy('ordering','asc')->paginate(50);
		return view('story', compact('story','topLastedChapter','chapters','relateStories'));
	}

	public function getChapterView($storySlug, $ordering)
	{
		// $chapter = Chapter::whereHas('story', function($query) use ($storySlug,$ordering){
		// 	$query->where('slug',$storySlug)->where('ordering',$ordering);
		// })->get();

		$story = Story::findBySlugOrFail($storySlug);

		$chapter = $story->chapter()->where('ordering',$ordering)->first();

		// $temp = Chapter::find($chapter->id);

		$next = $chapter->getNextChapter();

		$previous = $chapter->getPreviousChapter();

		event(new ChapterView($chapter));

		return view('chapter', compact('chapter','next', 'previous'));
	}

	public function getDashboard()
	{
		return view('admin.dashboard');
	}

	public function test()
	{
		return view('test');
	}

	public function paginate($items, $perPage = 15, $page = null)
	{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
		$items = $items instanceof Collection ? $items : Collection::make($items);
		return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
	            'path' => Paginator::resolveCurrentPath(),
	            'pageName' => 'page',
	        ]);
	}

	public function getLogin()
	{
		return view('admin.login');
	}

	public function postLogin(Request $request)
	{
		$username = $request->username;
		$password = $request->password;
        $this->validate($request,
            [
                'username'=> 'required',
                'password'=>'required',
            ],
            [
                'name.required'=> 'Bạn chưa nhập tài khoản',
                'password.required'=>'Bạn chưa nhập password'
            ]);
        $remember = $request->remember == 2 ? true : false;

        // print_r($remember);
        // die();

		if(Auth::attempt(['name' => $username, 'password' => $password], $remember))
		{
            Auth::login(Auth::user());
            return redirect()->route('admin.dashboard');
		}

		else return redirect()->back()->withInput()->with('thongbao','Tài khoản hoặc mật khẩu không chính xác');
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('login');
	}
}
