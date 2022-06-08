<?php

namespace App\Http\Resource;

use App\Category as CategoryModel;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MediaResource as MediaResource;

class PostResource extends JsonResource
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
            'slug' => $this->slug,
            'status'=> $this->status,
            'icon' => $this->icon,
            'counts' => $this->counts,
            'category' => CategoryModel::find($this->category_id),
             'category_id' => $this->category_id,
            'featured' => $this->when(1, function () {
                if (count($this->getMedia('featured')) > 0) {
                    return $this->getMedia('featured')[0]->getFullUrl();
                }
            })
            ,'featured_thumb' => $this->when(1, function () {
                if (count($this->getMedia('featured')) > 0) {
                    return $this->getMedia('featured')[0]->getFullUrl('thumb');
                }
            }),
            'featured_medium' => $this->when(1, function () {
                if (count($this->getMedia('featured')) > 0) {
                    return $this->getMedia('featured')[0]->getFullUrl('medium');
                }
            }),
            'gallery' => MediaResource::collection($this->getMedia('gallery')),
            'attributes' => $this->when(1, function () {
                if ($this->attributes != null) {
                    return json_decode($this->attributes);
                }else{
                    return "[]";
                }
            }),
            'tags' => $this->tags,
            'tags_id' => $this->tags->pluck('id')->toArray(),
            'meta_description' =>$this->meta_description,
            'author' => $this->user != null?$this->user->name:'',

            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at

        ];
    }
}
