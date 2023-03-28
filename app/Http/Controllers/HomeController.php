<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $path = public_path('images');
        $image = Upload::orderBy('id', 'DESC')->first();

        return view('home')
        ->with('image', $image)
        ->with('path', $path);
    }

    public function bibliotheek() {

        $images = Upload::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();

        return view('bibliotheek')
        ->with('images', $images);
    }

}
