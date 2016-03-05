<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function menu()
    {
        return $this->hasMany('App\Models\Menu','category_id','id');
    }
}

