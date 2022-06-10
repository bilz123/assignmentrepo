<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Response;

class defaultController extends Controller
{
    public function getAllCategory()
    {
        $category = Category::all();
        return response()->json(['data' => $category , 'status' => '200']);
    }
}
