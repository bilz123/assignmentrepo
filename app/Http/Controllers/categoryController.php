<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use App\Http\Requests\storeCategoryRequest;
use App\General;


class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }
   
    public function categorylisting(Request $request)
    {
            $categories = Category::get();
          
            return Datatables::of($categories)
               
                ->addColumn('action', function($row){
                    $actionBtn = '<a id="mybutton" data-action="VIEW"  data-url="' . route('categories.show', $row->id) .'" onclick="mainAjaxCall(this)" data-type="get" class="view btn btn-primary btn-sm">View</a>
                    <a  class="edit btn btn-success btn-sm" data-action="EDIT_CAT" data-url="' . route('categories.edit',$row->id) .'" onclick="mainAjaxCall(this)" data-type="get" >Edit</a>
                     <a  data-action="DELETE"  data-url="' . route('categories.destroy', $row->id) .'" onclick="mainAjaxCall(this)" data-type="delete" class="delete btn btn-danger btn-sm">Delete</a>
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
        $validator = $request->validated();
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
      
        $data=[];
       
        if( $request->file('file'))
       { 
           $general = new General();
           $imageName = $general->myTestFunction($request->file('file'));
           $data['image'] ='images/'.$imageName;
        }
        $data['name'] = $request->name;
        $data['description'] = $request->description;
      
        Category::create($data);

        return response()->json(['message' => 'Category added Succesfully!' , 'status' => '200']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $view_category = Category::findOrFail($id);
    
      return response()->json([ 'data' => $view_category ,'message' => 'Success!' , 'status' => '200']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
      
        return response()->json([ 'data' => $category ,'message' => 'Success!' , 'status' => '200']);
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
        $data['description'] = $request->description;
        
        $category_update = Category::findOrFail($id);
        $category_update->update( $data);
        return response()->json([ 'data'=> $category_update,'message' => 'Category update Succesfully!' , 'status' => '200']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if(\Storage::exists('public/'.$category['image']))
        {
            \Storage::delete('public/'.$category['image']);
        }
        $category->delete();
        return response()->json(['message' => 'Category deleted Succesfully!' , 'status' => '200']);
    }

    
}
