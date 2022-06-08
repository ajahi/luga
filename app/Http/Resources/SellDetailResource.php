<?php

namespace App\Http\Resources;
use App\Sell;
use App\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class SellDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'product'=>Product::findOrFail($this->product_id),
            'sell'=>Sell::findOrFail($this->sell_id),
            'price'=>$this->price
        ];
    }
}
