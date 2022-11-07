<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

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
        return view('home');
    }

    /**
     * Show the application settings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings()
    {
        $data["items"] = Item::paginate(5);
        return view('settings')->with($data);
    }
}
