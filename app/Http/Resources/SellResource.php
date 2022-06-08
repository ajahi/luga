<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellResource extends JsonResource
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
            'firstname'=>$this->first_name,
            'lastname'=>$this->last_name,
            'status'=>$this->status,
            'quantity'=>$this->quantity,
            'SellDetail'=>SaleDetailResource::collection($this->selldetail)
        ];
    }
}
