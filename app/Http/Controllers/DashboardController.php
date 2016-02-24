<?php
/**
 * Created by PhpStorm.
 * User: erdi
 * Date: 22.02.2016
 * Time: 16:07
 */

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    public function getIndex()
    {
        return view('home.index');
    }

    public function postAddNewCategory()
    {
        $category = new Category();

        $category->category_name = Input::get('category_name');
        if ($category->save()){
            return Redirect::to('/');
        }else{
            return Redirect::to('/')->with('error','Error');
        }

    }

    public function postAddNewMenu()
    {
        $menu = new Menu();
        $menu->menu_name = Input::get('menu_name');
        $menu->category_id = Input::get('category');
        if($menu->save()){
            return Redirect::to('/');
        }else{
            return Redirect::to('/')->with('error','Errror');
        }
    }
}