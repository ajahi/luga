<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Resources\TagResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('cms.tag.tagindex',['Tag'=>Tag::all()]);

        // $query = Tag::query();
        // if ($request->has('title')) {
        //     $query->where('title', 'like', '%' . $request->title . '%')
        //             ->orWhere('description', 'like', '%' . $request->title . '%');
        // }
        // return TagResource::collection($query->paginate($request->input('limit')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.tag.tagcreate');
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
                'title' => 'required|unique:tags'
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $tag = Tag::create($request->all());

            return redirect('/tag')->with('success','You have successfully created a tag.');

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
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TagResource(Tag::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cms.tag.tagedit',['post'=>Tag::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {

            $validation = Validator::make($request->all(), [
                'title' => 'required'
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            $tag = Tag::findOrFail($id);
            $tag->fill($request->all())->save();

           
            return redirect('/tag')->with('info','You have succcessfully edited a tag.');

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return redirect('/tag')->with('warning','Only admin and superadmin are allowed to edit a tag.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            Tag::whereId($id)->delete();
            $return = ["status" => "Success",
                "error" => [
                    "code" => 200,
                    "errors" => 'Deleted'
                ]];
            return redirect('/tag')->with('error','You have successfully deleted a tag.');

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return redirect('/tag')->with('warning','Only admin and superadmin are allowed to delete tag.');
        }
    }
}
