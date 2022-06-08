<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SellResource;
use App\Product;
use App\SellDetail;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      
    }

    public function buy(){
        return view('sellhome');
    }


    public function order(Request $request){
        $validation = Validator::make($request->all(), [
            'first_name'=>'required|text',
            'last_name'=>'required|text',
            'contact_number'=>'required|min:9800000000|numeric',
            'cart' => 'required|min:1',
            'cart.*.product_id'=> 'required|exists:products,id'
        
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors() , 422);
        }
        $sell_data['note']=>$request->note;
        $sell_data['first_name'] = $request->first_name;
        $sell_data['last_name'] = $request->last_name;
        $sell_data['mobile_number'] = $request->mobile_number;
        $sell_data['status']='ordered'
        $sell=Sell::create($sell_data);

        foreach ($request->cart as $item)
        {
            $product = Product::findOrFail($item['product_id']);
            
            $cart['product_id'] = $item['product_id'];
            $cart['sale_id'] = $sale->id;
            $cart['quantity'] = $item['quantity'];
            $cart['sale_price'] = $product->net_sale_price;
       
            /* changing stock quantity */
          
            $product->fill($product_data)->save();
            SellDetail::create($cart);
            $cost = DB::table('sale_details')
                ->select(DB::raw('SUM(quantity * sale_price) as total'))
                ->where('sale_id', '=', $sale->id)
                ->get();
            $sale = Sell::findOrFail($sale->id);
            $sale->subtotal = $cost[0]->total;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
