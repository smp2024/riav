<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Carousel;
use Config;
use Str;
use Image;

class DashboardController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getDashboard()
    {
        $users = User::count();
        $carousels = Carousel::where('status', 1)->count();

        $data = [
                    'users'=> $users,
                    'carousels'=> $carousels
                ];

        return view('admin.partials.dashboard', $data);

    }

}
