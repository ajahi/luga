<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;


class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.productcategory.productcategoryindex',['productcategory'=>ProductCategory::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.productcategory.productcategorycreate',['productcategory'=>ProductCategory::where('parent_id',null)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            $validation = Validator::make($request->all(), [
                'title' => 'required|min:3',
                'description' => 'required|min:5',
                'parent_id' => ['exists:product_categories,id','nullable']
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $position = ProductCategory::count();
            $product_category = new ProductCategory();
            $product_category->title = $request->title;
            $product_category->slug = slug(strtolower($request->title));
            $product_category->description = $request->description;
            $product_category->position = $position +1;
            if($request->parent_id){
                $product_category->parent_id = $request->parent_id;
            }
            
            $product_category->save();
            
            return redirect('/productcategory')->with('success','You have successfully created a product category.');
            // return new  ProductCategoryResource($product_category);
        }else{
            return redirect('/productcategory')->with('info','Only admin and superadmin can create product category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('cms.productcategory.productcategoryshow',['productcategory'=>ProductCategory::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cms.productcategory.productcategoryedit',['productcategory'=>ProductCategory::findOrFail($id),'parent'=>ProductCategory::where('parent_id',null)->get()]);
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
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            $validation = Validator::make($request->all(), [
                'title' => 'required',
                'description'=>'required|min:5',
                'parent_id' => 'exists:product_categories,id|nullable',
                
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors() , 422);
            }
            $product_category = ProductCategory::findOrFail($id);
            $product_category->title = $request->title;
            $product_category->slug = slug(strtolower($request->title));
            $product_category->description = $request->description;
            $product_category->parent_id = $request->parent_id;
            $product_category->position=$request->position;
          
            $product_category->save();
            if ($request->has('image')) {
                $product_category->clearMediaCollection('image');
                $product_category->addMediaFromRequest('image')->toMediaCollection('image');
            }
            return redirect('/productcategory')->with('success','You have successfully edited a productcategory.');
            
        } else {
            return redirect('/productcategory')->with('info','admin and superadmin can only edit a productcategory');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            $product_category = ProductCategory::findOrFail($id);
            if(count($product_category->products)>0){
                return response()->json(['error'=>'Cannot delete. One or many Products are attached to this category.'], 403);
            }
           $product_category->products()->detach();
           
            $product_category->delete();
           
            return redirect('/productcategory')->with('error','You have successfully deleted a productcategory.');
        }
        else {
            return redirect('/productcategory')->with('warning','admin and superadmin are allowed to delet a productcategory.');
        }
    }
}
