<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Library\Slim;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index() {
        $title = "Profile | User Panel";

        $user = auth()->user();

        return view('user.profile', compact('user', 'title'));
    }

    public function update(Request $request) {
        $userId = auth()->guard('admin')->user()->id;
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
        ]);

        $user = User::find($userId);
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
