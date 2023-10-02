<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Freshbitsweb\Laratables\Laratables;

class PageController extends Controller
{
    protected static $counter;
    
    public function __construct()
    {
        
    }

    public function index() {
        $title = 'All pages | Admin Panel';

        return view('admin.page.index', ['title' => $title]);
    }

    public function add() {
        $title = 'Add Page | Pages | Admin Panel';
        return view('admin.page.add-page', ['title' => $title]);
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'title'       => 'required',
            'keywords'    => 'required',
            'description' => 'required|max:200',
            'content'     => 'required',
            'locked'      => 'required',
            'place'       => 'required',
        ], [
          'locked.required' => 'You must select yes or no',
          'place.required'  => 'You must select at least one option',
        ]);

        $slug = Str::slug($request->title, '-');

        Page::create([
            'title' => $validate['title'],
            'keywords' => $validate['keywords'],
            'description' => $validate['description'],
            'content' => $validate['content'],
            'locked' => $validate['locked'], 
            'place' => $validate['place'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.pages')->with('msg', 'Page was successfully posted');
    }

    public function edit($id) {
      $page = Page::find($id);
      $title =  $page->title .' | Pages | Admin Panel';

      return view('admin.page.edit-page', ['page' => $page, 'title' => $title]);
    }

    public function update(Request $request, $id) {
        $validate = $request->validate([
          'title'       => 'required',
          'keywords'    => 'required',
          'description' => 'required|max:200',
          'content'     => 'required',
          'locked'      => 'required',
          'place'       => 'required',
        ], [
          'locked.required'  => 'You must select yes or no',
          'place.required'   => 'You must select at least one option'
        ]);

      $page = Page::find($id);

      $page->title = $validate['title'];
      $page->slug = Str::slug($validate['title'], '-');
      $page->keywords = $validate['keywords'];
      $page->description = $validate['description'];
      $page->content = $validate['content'];
      $page->locked = $validate['locked'];
      $page->place = $validate['place'];

      $page->save();

      return redirect()->route('admin.pages')->with('msg', 'Page updated successfully');
    } 

    public function delete($id) {
      $page = Page::find($id);
      Banner::where('page', $page->title)->delete();
      $page->delete();

      return Redirect::back()->with('msg', 'Page was successfully deleted');
    }

    public function getPages()
    {
		return Laratables::recordsOf(Page::class, PageController::class);
    }
    
	public static function laratablesQueryConditions($query)
	{
		self::$counter = app('request')->input('start');
		return $query->where('id', '>', 0);
  }

  public static function laratablesId($page)
  {
    return ++self::$counter;
  }

  public static function laratablesCreatedAt($page) 
  {
    return date('d M Y', strtotime($page->created_at));
  }
  
  public static function laratablesUpdatedAt($page) 
  {
    return date('d M Y', strtotime($page->created_at));
  }

  public static function laratablesCustomAction($page)
	{
		return view('admin.page.buttons', compact('page'))->render();
  }
}
