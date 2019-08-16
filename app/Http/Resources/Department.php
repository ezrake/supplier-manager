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
            'id' => $this->id,
            'name' => $this->name,
            'requisitions' => $this->when(
                $request->is('department/*/requisitions'),
                $this->requisitionsTransform($this->request)
            )
        ];
    }

    public function requisitionsTransform(Request $request)
    {
        $query = $request->query();
        if (isset($query['status'])) {
            $requisitions = $this->requisitions()
                ->where('status', $query['status'])
                ->paginate(20);
            return $requisitions;
        }

        $requisitions = $this->requisitions()->paginate(20);
        return $requisitions;
    }
}
