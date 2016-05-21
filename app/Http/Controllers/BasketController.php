<?php
/**
 * Created by PhpStorm.
 * User: erdi
 * Date: 4.03.2016
 * Time: 15:29
 */

namespace App\Http\Controllers;

use App\Models\Basket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class BasketController extends Controller
{
    public function basket()
    {
        $allBasket = Basket::all();
        $date = date('d/m/Y h:i');
        $total = DB::table('baskets')->sum('price');
        $total = number_format($total,2);
        $promotion = DB::table('baskets')->sum('promotion');
        $promotion = number_format($promotion,2);
        $subTotal = false;
        $toPay = $total;

        $data = array(
            'allBasket' => $allBasket,
            'date' => $date,
            'total' => $total,
            'promotion' => $promotion,
            'subTotal' => $subTotal,
            'toPay' => $toPay
        );
        return view('home.basket.index',$data);
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

    public function bosalt()
    {
        $basket = Basket::truncate();
        if($basket){
            return Redirect::to('/');
        }
    }
}