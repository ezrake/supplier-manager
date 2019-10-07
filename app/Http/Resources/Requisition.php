<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Requisition extends JsonResource
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
            'items' => $this->items,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'department' => "/departments/$this->department_id",
            'order' => "/orders/$this->order_id",
        ];
    }
}
