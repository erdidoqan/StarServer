<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Basket;
use App\Models\Category;
use App\Models\Menu;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $allBasket = Basket::all();

        return view('home.dash.index')->with('category',$category)->with('allBasket',$allBasket);
    }
}
