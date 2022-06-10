<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\storeCategoryRequest;
use Image;
use App\General;
use Helper; // Important

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index()
    {
       return view('product.index');
    }

    public function productslisting(Request $request)
    {
        
             
            $products = Product::get();
          
            return Datatables::of($products)
               
                ->addColumn('action', function($row){
                    $actionBtn = '<a id="mybutton" data-action="VIEW_PRODUCT"  data-url="' . route('products.show', $row->id) .'" onclick="mainAjaxCall(this)" data-type="get" class="view btn btn-primary btn-sm">View</a>
                    <a  class="edit btn btn-success btn-sm" data-action="EDIT_PRODUCT" data-url="' . route('products.edit',$row->id) .'" onclick="mainAjaxCall(this)" data-type="get" >Edit</a> 
                    <a id="mybutton" data-action="DELETE_PRODUCT"  data-url="' . route('products.destroy', $row->id) .'" onclick="mainAjaxCall(this)" data-type="delete" class="delete btn btn-danger btn-sm">Delete</a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
                    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeCategoryRequest $request)
    {
        $validated = $request->validated();
        
        $data=[];
       
        if( $request->file('file'))
       { 
           $general = new General();
           $imageName = $general->myTestFunction($request->file('file'));
           $data['image'] ='images/'.$imageName;
        }
        $data['name'] = $request->name;
        $data['sale_price'] = $request->sale_price;
        $data['purchase_price'] = $request->purchase_price;
        $data['description'] = $request->description;
     
        Product::create($data);

        return response()->json(['message' => 'Product added Succesfully!' , 'status' => '200']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view_product = Product::findOrFail($id);
    
      return response()->json([ 'data' => $view_product ,'message' => 'Success!' , 'status' => '200']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
      
       
        return response()->json([ 'data' => $product ,'message' => 'Success!' , 'status' => '200']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['sale_price'] = $request->sale_price;
        $data['purchase_price'] = $request->purchase_price;
        $data['description'] = $request->description;
        dd($data);
        $product_update = Product::findOrFail($id);
       
        $product_update->update( $data);
        return response()->json([ 'data'=> $product_update,'message' => 'Product update Succesfully!' , 'status' => '200']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
         if(\Storage::exists('public/'.$product['image']))
        {
            \Storage::delete('public/'.$product['image']);
        }
       
        // $general = new General();
        
        // $imageName = $general->deleteImageFile($product['image']);
        $product->delete();
        return response()->json(['message' => 'Product deleted Succesfully!' , 'status' => '200']);
    }
}
