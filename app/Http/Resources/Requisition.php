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
        $data = [
            'id' => $this->id,
            'items' => $this->items,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'department' => "/api/departments/$this->department_id",
            'order' => $this->when(
                !($this->status == 'waiting' || $this->status == 'rejected'),
                "/api/orders/$this->order_id"
            )
        ];
        if ($request->has('fields')) {
            $fields = $request->input('fields');
            $fields = \str_replace(
                ['created_at', 'updated_at', 'department_id', 'order_id'],
                ['createdAt', 'updatedAt', 'department', 'order'],
                $fields
            );
            $fields = \explode(',', $fields);
            $fields = array_flip($fields);

            return array_intersect_key($data, $fields);
        } else {
            return $data;
        }
    }
}
