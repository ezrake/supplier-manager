<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payments extends JsonResource
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
            'amount' => $this->amount,
            'transanctionDetails' => $this->transaction_details,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'order' => "/orders/$this->order_id",
        ];
    }
}
