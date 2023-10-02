<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;
use App\Http\Library\Slim;

class SeoController extends Controller
{
    public function __construct()
    {
        
    }

    public function index($name) {
        $title = $name. ' | SEO | Admin Panel';
        $seo = Seo::where('name', $name)->first();

        return view('admin.seo.seo', ['seo' => $seo, 'title' => $title]);
    }

    public function update(Request $request, $name) {
        $validate = $request->validate([
            'title'       => 'required',
            'keywords'    => 'required',
            'description' => 'required|max:200',
        ]);


        $cropperImg = $this->handleCropper('image');
        $seo = Seo::where('name', $name)->first();

        if(($seo->image && $cropperImg != false)) {
            Slim::delete($seo->image);
        }

        $seo->title = $validate['title'];
        $seo->keywords = $validate['keywords'];
        $seo->description = $validate['description'];
        if($cropperImg != false) {
            $seo->image = $cropperImg;
        }

        $seo->save();

        return back()->with('msg', 'SEO updated successfully');
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
