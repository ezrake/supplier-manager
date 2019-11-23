<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'self' => "/api/orders/$this->id",
            'id' => $this->id,
            'details' => $this->details,
            'delivered' => $this->delivered,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'deletedAt' => $this->deleted_at,
            'supplier' => "/api/suppliers/$this->supplier_id",
            'payments' => "/api/orders/$this->id/payments"
        ];
    }
}
