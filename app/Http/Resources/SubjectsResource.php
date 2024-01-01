<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'package_id' => $this->package_id ,
            'name' => $this->name ,
            'cost' => $this->cost ,
            'created_at' => $this->created_at ,
            'updated_at' => $this->updated_at ,
            'subscribed' => $this->has_relation,
            'lectures' => LecturesResource::collection($this->lectures),
        ];
    }
}
