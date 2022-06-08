<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resource\TempMenuResource as TempMenuResource;

class MenuResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'position' => $this->position,
            'description' => $this->description,
            'url' => $this->url,

            'parent' => $this->parent,
            'children' =>  TempMenuResource::collection($this->children),
            'photo' => $this->when(1, function () {
                if (count($this->getMedia('photo')) > 0) {
                    return $this->getMedia('photo')[0]->getFullUrl();

                } else {
                    return "https://kcl-mrcdtp.com/wp-content/uploads/sites/201/2017/05/person_icongray-300x300.png";
                }
            }),
        ];
    }
}
