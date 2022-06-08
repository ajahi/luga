<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slogan' => $this->slogan,
            'working_days' => $this->working_days,
            'website' => $this->website,
            'email' => $this->email,
            'location' => $this->location,
            'telephone' => $this->telephone,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'google' => $this->google,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
            'skype' => $this->skype,
            'logo' => $this->when(1, function () {
                if (count($this->getMedia('logo')) > 0) {
                    return $this->getMedia('logo')[0]->getFullUrl();
                }
            }),
            'banner' => $this->when(1, function () {
                if (count($this->getMedia('banner')) > 0) {
                    return $this->getMedia('banner')[0]->getFullUrl();
                }
            }),
            'bottom_banner' => $this->when(1, function () {
                if (count($this->getMedia('bottom_banner')) > 0) {
                    return $this->getMedia('bottom_banner')[0]->getFullUrl();
                }
            }),
            'attributes' => $this->when(1, function () {
                if ($this->attributes != null) {
                    return json_decode($this->attributes);
                } else {
                    return "[]";
                }
            }),
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at


        ];
    }
}
