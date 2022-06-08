<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PermissionResource as PermissionResource;

class RoleResource extends JsonResource
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
            'name' => $this->name ,
            'display_name' => $this->display_name,
            'description' => $this->description ,
            'permission' => PermissionResource::collection($this->perms),
            'permission_list' => $this->perms->pluck('id')->toArray()

        ];
    }
}
