<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preference;
use Illuminate\Support\Facades\Redirect;
use App\Http\Library\Slim;

class PreferenceController extends Controller
{
    public function __construct()
    {
    }

    public function index() {
        $title = 'Preferences | Admin Panel';
        $setting = Preference::all();

        return view('admin.preferences.settings', ['title' => $title, 'setting' => $setting]);
    }

    public function store(Request $request) {
        $headerImage = $this->handleCropper('header_image');
        $hdImage = Preference::where('name', 'header_image')->first();

        if($hdImage) {
            if($headerImage) {
                Slim::delete($hdImage->value);
            }
        }

        if($headerImage) {
            Preference::updateOrInsert(
                ['name' => 'header_image'],
                ['value' => $headerImage],
            );
        }

        $input = $request->all();
        
        foreach($input as $key => $value) {
            if($key != '_token' && $key != 'header_image' && $key != 'addPost') {
                Preference::updateOrInsert(
                    ['name' => $key],
                    ['value' => $value],
                );
            }
        }

        return back()->with('msg', 'Preferences Updated successfully');
    }

    public function deleteImage($id) {
        $image = Preference::find($id);

        if($image) {
            Slim::delete($image->value);
            $image->delete();
            return back();
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        }
    }

    public static function getPref($name) {
        $preference = Preference::where('name', $name)->first();
        if($preference) {
            return $preference->value;
        }
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

            return $output['name'];
        }
    }
}
