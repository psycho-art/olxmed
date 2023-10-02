<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $title = 'Dashboard | User Panel';

        return view('user.index', compact('title'));
    }
}
