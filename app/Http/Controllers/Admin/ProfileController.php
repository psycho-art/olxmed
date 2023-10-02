<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Library\Slim;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index() {
        $title = "Profile | Admin Panel";

        $user = auth()->guard('admin')->user();

        return view('admin.profile', compact('user', 'title'));
    }

    public function update(Request $request) {
        $userId = auth()->guard('admin')->user()->id;
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
        ]);

        $user = Admin::find($userId);
        $password = $request->password;
        $cropperImg = $this->handleCropper('image');
        if($user->image != '' && $cropperImg != false) {
            Slim::delete($user->image);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if($password != '') {
            $user->password = Hash::make($password);
        }
        if($cropperImg != false) {
            $user->image = $cropperImg;
        }
        $user->save();

        return back()->with(['msg' => 'Profile was successfully updated']);
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
