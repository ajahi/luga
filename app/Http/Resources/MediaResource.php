<?php
/**
 * Created by PhpStorm.
 * User: bomtry
 * Date: 12/19/18
 * Time: 3:22 PM
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->getFullUrl()
        ];
    }

}