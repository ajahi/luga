<?php

namespace App\Http\Controllers;

use App\Http\Resource\SliderResource;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Slider::all();

        return view('cms.slider.sliderindex',['slider'=>$query]);
        // if ($request->has('title')) {
        //     $query->where('title', 'like', '%' . $request->title . '%');
        // }
        // if($request->has('description')) {
        //     $query->where('description',$request->description);
        // }
        // $query->orderByDesc('created_at');
        // return SliderResource::collection($query->paginate($request->input('limit')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('cms.slider.slidercreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return SliderResource
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            $validation = Validator::make($request->all(), [
                'title' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            $slider = Slider::create($request->all());

            if ($request['featured'] != null) {
                $slider->clearMediaCollection('featured');

                $slider->addMediaFromRequest('featured')->toMediaCollection('featured');
            }
            if($request['image']){
                $slider->addMediaFromRequest('image')->toMediaCollection('images');
            }
            return redirect('/slider');

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
     * @param  \App\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SliderResource(Slider::find($id));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cms.slider.slideredit',['post'=>Slider::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\slider  $slider
     * @return SliderResource
     */
    public function update(Request $request, $id)
    {

        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            $validation = Validator::make($request->all(), [
                'title' => 'required'
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }


            $slider = Slider::findOrFail($id);
            $slider->fill($request->all())->save();
            if ($request['featured'] != null) {
                $slider->clearMediaCollection('featured');

                $slider->addMediaFromRequest('featured')->toMediaCollection('featured');
            }
            if($request->has('image')){
                $slider->clearMediaCollection('images');
                $slider->addMediaFromRequest('image')->toMediaCollection('images');
            }
            $slid=Slider::findOrFail($id);
            return redirect('/slider');

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
     * @param  \App\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            $slider=Slider::find($id);
            $slider->clearMediaCollection();
            $slider->delete();
            $return = ["status" => "Success",
                "error" => [
                    "code" => 200,
                    "errors" => 'Deleted'
                ]];
            return redirect('/slider');

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }
}
