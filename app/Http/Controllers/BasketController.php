<?php
/**
 * Created by PhpStorm.
 * User: erdi
 * Date: 4.03.2016
 * Time: 15:29
 */

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class BasketController extends Controller
{
    public function basket()
    {
        return view('home.basket.index');
    }

    public function newBasket()
    {
        //return Input::all();
        $basket = new Basket();
        $basket->menu_name = Input::get('menu_name');
        $basket->menu_id = Input::get('menu_id');
        $basket->category_id = Input::get('category_id');
        $basket->price = Input::get('price');
        $basket->count = Input::get('count');

        if($basket->save()){
            return Redirect::to('/');
        }else{
            return Redirect::to('/')->with('error','Error');
        }
    }
}