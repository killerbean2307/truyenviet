<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Story;
use App\Author;
use App\Chapter;
use App\User;
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
    	$newestChapters = Chapter::getNewestChapter(null, 10);
    	return view('index', compact('newestChapters'));
    }
}
