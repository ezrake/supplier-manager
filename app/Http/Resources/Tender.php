<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\Payment as PaymentResource;

class Tender extends JsonResource
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
            'details' => $this->details,
            'status' => $this->status,
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
            'supplier' => $this->whenLoaded('supplier'),
            'expiry' => $this->expiry,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'deletedAt' => $this->deleted_at
        ];
    }
}
