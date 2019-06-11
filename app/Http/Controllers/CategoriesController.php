<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;


class CategoriesController extends Controller
{
    public function getchildCategory(){
        return Category::with('children')->where('parent_id',0)->orderBy('name', 'asc')->get();
    }
}
