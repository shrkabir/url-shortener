<?php

namespace App\Http\Controllers\Backend;

use App\Models\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $urls= Url::where('user_id', Auth::id())->get();
        
        return view('backend.dashboard', compact('urls'));
    }
}
