<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'featured' => $this->when(1, function () {
                if (count($this->getMedia('featured')) > 0) {
                    return $this->getMedia('featured')[0]->getFullUrl();

                } else {
                    return null;
                }
            }),
        ];
    }
}

