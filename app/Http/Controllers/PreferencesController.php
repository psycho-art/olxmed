<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;

class PreferencesController extends Controller
{
    public static function getPref($name) {
        $preference = Preference::where('name', $name)->first();
        if($preference) {
            return $preference->value;
        }
    }
}
