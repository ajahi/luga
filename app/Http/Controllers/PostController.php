<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resource\CategoryResource;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

use App\Post;

use App\Http\Resource\PostResource;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Sluggable\SlugOptions;
use Validator;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Post::query();
        if ($request->has('category')){
            $query->where('category_id', $request->category);
        }
        if ($request->has('status')){
            $query->where('status', $request->status);
        }
        if ($request->has('title')){
            $query->where('title', 'like' . $request->title, '%');
        }
        if ($request->has('description')){
            $query->where('description', $request->description);
        }
        if ($request->has('user')){
            $query->where('user_id', $request->user);
        }
        if($request->has('filter')) {
            if ($request->filter === 'popular') {
                $query->orderByDesc('counts');
            }
        }

        return view('cms.post.postindex',[
            'posts'=>Post::orderBy('id','DESC')->get()
        ]);


        $post = $query->orderByDesc('created_at')->paginate(request('limit'));
        return PostResource::collection($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.post.postcreate',['category'=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     { 
        $user = Auth::user();

        if ($user->hasRole(['admin','super_admin'])) {
            // for validation purpose
            if($request->tags_id){
                $request['tags'] = explode(",",$request->tags_id);
            }
            $validation = Validator::make($request->all(), [
                'title' => 'required|unique:posts',
                'description' => 'required',
                'status' => 'required|in:published,draft',
                'category_id' => 'required',
                'tags.*' => 'exists:tags,id',
                'image'=>'required'
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            $request['user_id'] = Auth::user()->id;
            /*converting slug*/
            $request['slug'] = slug($request->title);
            $post=Post::create($request->all());

            if(empty($request->tags_id)){
                $post->tags()->detach();
            }else {
                $post->tags()->sync(explode(",", $request->tags_id));
            }
            if ($request->has('image')) {
                /*$product->addMediaFromRequest('image')->toMediaCollection('image');*/
                $post->addMediaFromRequest('image')->toMediaCollection('images');
                // dd('image is availeble');
            }
            return redirect('/post')->with('success','You have successfully created a post.');
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
     * @return PostResource
     */
    public function show($id)
    {   return view('cms.post.postshow',['product'=>Post::find($id)]);
        
        // $post = Post::findOrFail($id);
        // $post->increment('counts');
        // return new PostResource($post);
    }

    /**
        This function returns the result from slug search.
     */
    public function slug(Request $request,$post)
    {
        $post= Post::where('slug', $request->slug)->first();
        $post->increment('counts');

        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        return view('cms.post.postedit',[
            'post'=>Post::findOrFail($id),
            'category'=>Category::all()  
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:published,draft',
            'category_id' => 'required',
            'tags.*' => 'exists:tags,id'
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }
        
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {

            // for validation purpose
            if($request->tags_id){
                $request['tags'] = explode(",",$request->tags_id);
            }

            $validation = Validator::make($request->all(), [
                'title' => ['sometimes', Rule::unique('posts')->ignore($id)],
                //'slug' => ['sometimes', Rule::unique('posts')->ignore($id)],
                'tags.*' => 'exists:tags,id'
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
           
            $post = Post::findOrFail($id);
            $request['user_id'] = Auth::user()->id;
            /*converting slug*/
            $request['slug'] = slug($request->title);
           
            if ($request->has('image')) {
                
                $post->clearMediaCollection('images');  
                $post->addMediaFromRequest('image')->toMediaCollection('images');
            }  

            $post->fill($request->all())->save();

            if(empty($request->tags_id)){
                $post->tags()->detach();
            }else {
                $post->tags()->sync(explode(",", $request->tags_id));

            }


            if ($request['featured'] != null) {
                $post->clearMediaCollection('featured');
                $post->addMediaFromRequest('featured')->toMediaCollection('featured');

            }

            $post = Post::findOrFail($id);

            return redirect('/post')->with('success','You have successfully edited a post.');

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
            $post=Post::find($id);
            $post->clearMediaCollection();
            $post->delete();
            $return = ["status" => "Success",
                "error" => [
                    "code" => 200,
                    "errors" => 'Deleted'
                ]];
            return redirect('/post')->with('error','You have deleted a post.');

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }

    public function uploads(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole(['admin','super_admin'])) {

            $validation = Validator::make($request->all(), [
                'post' => 'required|numeric',
            ]);

            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            $post = Post::findOrFail($request->post);

            if ($request['file'] != null) {

                $post->addMediaFromRequest('file')->toMediaCollection('gallery');


            }
            $post = Post::findOrFail($request->post);
            return MediaResource::collection($post->getMedia('gallery'));

        }
    }

    public function deleteMedia($id, $mediaID)
    {
        $user = Auth::user();

        if ($user->hasRole(['admin','super_admin'])) {

            $post = Post::findOrFail($id);
        $media = $post->getMedia('gallery');

        $delete = $media->where('id', $mediaID)->first();
        $delete->delete();

        $post = Post::findOrFail($id);
        return MediaResource::collection($post->getMedia('gallery'));
        }
    }

    public function getTitleByCategories(Request $request){
        $request->validate([
            'categories' => 'required|array'
        ]);
        return Post::whereIn('category_id',$request->categories)
            ->select('title','category_id','id','slug')->get();
    }

    public function getPostByKeyIfTrue(Request $request){
        $request->validate([
            'key' => 'required'
        ]);
        return Post::where('attributes->'.$request->key.'->value',true)->get();
    }




}
