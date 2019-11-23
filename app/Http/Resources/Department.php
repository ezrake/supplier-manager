<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Department extends JsonResource
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
            'self' => "/api/departments/$this->id",
            'id' => $this->id,
            'name' => $this->name,
            'requisitions' => "/api/departments/$this->id/requisitions"
        ];
    }
}
