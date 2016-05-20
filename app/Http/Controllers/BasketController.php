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
        $allBasket = Basket::all();
        $date = Basket::orderBy('id','desc')->first();
        return view('home.basket.index')->with('allBasket',$allBasket)->with('date',$date);
    }

    public function newBasket()
    {
        $newBasket = Basket::firstOrCreate(array(
            'menu_name' => Input::get('menu_name'),
            'menu_id' => Input::get('menu_id'),
            'category_id' => Input::get('category_id'),
            'price' => Input::get('price'),
            'promotion_type' => Input::get('promotionType'),
            'promotion' => Input::get('promotion')
        ));

        $newBasket->count = Input::get('count');

        if($newBasket->save()){
            return Redirect::to('/');
        }else{
            return Redirect::to('/');
        }
    }
}