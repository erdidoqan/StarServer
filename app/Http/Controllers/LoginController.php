<?php
/**
 * Created by PhpStorm.
 * User: erdi
 * Date: 22.02.2016
 * Time: 15:26
 */
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;


class LoginController extends Controller
{
    public function postLogin()
    {
        var_dump(Input::all());
    }
}