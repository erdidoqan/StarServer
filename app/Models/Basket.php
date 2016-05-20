<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = ['menu_name','menu_id','category_id','price','promotion_type','promotion','count'];
}
