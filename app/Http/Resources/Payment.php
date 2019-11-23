<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payment extends JsonResource
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
            'self' => "/api/payments/$this->id",
            'id' => $this->id,
            'amount' => $this->amount,
            'transanctionDetails' => $this->transaction_details,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'order' => "/api/orders/$this->order_id",
        ];
    }
}
