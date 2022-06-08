<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->active,
            'roles' => $this->when(1, function () {
                if (count($this->roles) > 0) {
                  return  RoleResource::collection($this->roles);
                } else {
                    $role[0]['name'] = "customer";
                    $role[0]['display_name'] = "Customer";
                    $role[0]['description'] = "Customer Account";
                    $role[0]['permission'] = null;

                    return $role;
                }
            }),
            'role_id' => $this->when(1, function () {
                if (count($this->roles) > 0) {
                    ;
                    return  $this->roles[0]['id'] ;
                }
            }),
            'verified' => $this->when(1, function () {
                if ($this->activation_token == "") {
                    return  true;
                } else {

                    return false;
                }
            }),
            'avatar' => $this->when(1, function () {
                if (count($this->getMedia('profile')) > 0) {
                    return $this->getMedia('profile')[0]->getFullUrl();

                } else {
                    return "https://kcl-mrcdtp.com/wp-content/uploads/sites/201/2017/05/person_icongray-300x300.png";
                }
            }),
        ];
    }
}
