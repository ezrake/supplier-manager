<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Supplier extends JsonResource
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
            'user' => UserResource::collection(
                $this->whenLoaded('users')
            ),
            'tender' => TenderResource::collection($this->whenLoaded('tender')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'address' => $this->address,
            'details' => $this->details,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'deletedAt' => $this->deleted_at
        ];
    }
}
