<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Tender as TenderResource;
use App\Http\Resources\Order as OrderResource;

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
            'contacts' => $this->contacts,
            'account' => $this->account,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'deletedAt' => $this->deleted_at
        ];
    }
}
