<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Response;
class ApiController extends Controller
{
    public function searchApi(Request $request)
    {
        
        $min_sale_price = $request->min_s_price;
        $max_sale_price = $request->max_s_price;

        $min_purchase_price = $request->min_p_price;
        $max_purchase_price = $request->max_p_price;

       $searchData =  Product::where('name', $request->name)
        ->orWhere('name', 'like', '%' . $request->name . '%')
        ->orwhereBetween('sale_price', [$min_sale_price, $max_sale_price])
        ->orwhereBetween('purchase_price', [$min_purchase_price, $max_purchase_price])->paginate(15);
       
        return Response::json(['data' => $searchData , 'status' => 200]);
    }
}
