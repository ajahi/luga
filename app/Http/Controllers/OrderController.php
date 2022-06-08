<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('cms.order.orderindex',[
            'posts' => Order::orderBy('id', 'DESC')->get()
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('cms.order.ordershow',
        ['product'=>Order::find($id)->selldetails]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addedit($id,Request $request){
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            $add=Order::find($id);
            $add->address=$request->address;
            $add->save();
            return redirect()->back();
        }
        $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
    }
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin'])) {
            return view('cms.order.orderedit',['order'=>Order::findOrFail($id)]);
        }
        $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
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
                'status'=>['required','in:ordered,confirmed,cancelled']
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors() , 422);
            } 
            $order=Order::findOrFail($id);
            $order->status=$request->status;
            $order->save();
            return redirect('/order');
        }$return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);

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
            $order=Order::findOrFail($id);
            $order->delete();
            return redirect()->back();
        }
        $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
    }
}
