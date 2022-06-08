<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resource\CategoryResource;
use Validator;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {

        return view('cms.category.categoryindex',['category'=>Category::all()]);
        // $query = Category::query();
        // if ($request->has('title')) {
        //     $query->where('title', 'like', '%' . $request->title . '%');
        // }
        // if ($request->has('sortBy')) {
        //     $query->orderBy('id', $request->sortBy);
        // }
        // return CategoryResource::collection($query->paginate($request->input('limit')));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.category.categorycreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return CategoryResource
     */
    public function store(Request $request)
    { 
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            $validation = Validator::make($request->all(), [
                'title' => 'required|unique:categories',
                'description' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(),422);

            }
            /*converting slug*/
            $request['slug'] = slug($request->title);

            $data = collect($request->all());
            $data = $data->toArray();

            $position = Category::count();
            $data['position'] = $position + 1;
            $category = Category::create($data);

            if ($request['featured'] != null) {
                $category->clearMediaCollection('featured');
                $category->addMediaFromRequest('featured')->toMediaCollection('featured');
            }
            return redirect('/category')->with('success','You have successfully created a category.');

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return CategoryResource
     */
    public function show($id)
    {
        // return view('/categoryshow',['category'=>Category::findOrFail($id)]);
        // return new CategoryResource(Category::find($id));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cms.category.categoryedit',['post'=>Category::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return CategoryResource
     */
    public function update(Request $request, $id)
    { 
        $request->validate([
            'title' => 'required|unique:categories,title,'.$id,
            'description' => 'required',
        ]);

        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            $category = Category::findOrFail($id);
            /*converting slug*/
            $request['slug'] = slug($request->title);
            $category->fill($request->all())->save();


            if ($request['featured'] != null) {
                $category->clearMediaCollection('featured');
                $category->addMediaFromRequest('featured')->toMediaCollection('featured');
            }
            $category = Category::findOrFail($id);

            return redirect('/category')->with('success','You have successfully edited a post.');

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            Category::whereId($id)->delete();
            $return = ["status" => "Success",
                "error" => [
                    "code" => 200,
                    "errors" => 'Deleted'
                ]];
            return redirect('/category')->with('error','You have successfully deleted a category.');

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return redirect('/category')->with('warning','only Admin and Superadmin are allowed to delete.');
        }
    }


}
