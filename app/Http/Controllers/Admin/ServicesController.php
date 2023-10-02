<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Library\Slim;
use App\Models\Services;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicesController extends Controller
{

    protected static $counter;

    public function index() {
        $title = 'Service | Admin Panel';

        $services = Services::orderBy("id", 'desc')->get();



        return view('admin.service.index', compact('title', 'services'));
    }

    public function create() {
        $title = "Add Service | Admin Panel";

        return view('admin.service.create', compact('title'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'short_description' => 'required',
            'description' => 'required|max:240',
            'image' => 'required|max:1000',
        ]);


        $service_image = $this->handleCropper('image');

        $service = Services::create([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'description' => $request->description,
        ]);

        if($service_image != false && !empty($service)) {
            if($service_image == 'invalid extension') {
                return back()->withInput()->withErrors(['image' => 'Invalid extension']);
            } 

            Services::where('id', $service->id)->update([
                'image' => $service_image,
            ]);
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        } 

        return redirect()->route('admin.service.index')->with('msg', 'Product created successfully');

    }

    public function getPages()
    {
        return Laratables::recordsOf(Services::class, ServicesController::class);

    }

    public static function laratablesQueryConditions($query)
	{
		self::$counter = app('request')->input('start');
		return $query->where('id', '>', 0);
    }

    public static function laratablesId($service)
    {
        return ++self::$counter;
    }

    public static function laratablesCreatedAt($service) 
    {
        return date('d M Y', strtotime($service->created_at));
    }

    public static function laratablesCustomAction($service)
    {
        return view('admin.service.buttons', compact('service'))->render();
    }

    private function handleCropper($name)
    {
        $cropperImg = Slim::getImages($name);

        if($cropperImg == false)
            return false;

        if (count($cropperImg) > 1) {
            return $cropperImg;
        } else {
            $singleImgData  = array_shift($cropperImg);
            $name           = $singleImgData['output']['name'];
            $base64Data     = $singleImgData['output']['data'];
            $output         = Slim::saveFile($base64Data, $name);

            if(!is_array($output)) {
                if($output == 'invalid extension') {
                    return $output;
                }
            }

            return $output['name'];
        }
    }
}
