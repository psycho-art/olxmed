<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function __construct()
    {  
    }

    public function index() {
        $title = 'Dashboard | Admin Panel';

        return view('admin.index', compact('title'));
    }
}
