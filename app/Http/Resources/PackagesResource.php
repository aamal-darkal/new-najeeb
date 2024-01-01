<?php

namespace App\Http\Resources;

use App\Http\Requests\SubscribeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'id' => $this->id ,
                'name' => $this->name,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'subjects' => SubjectsResource::collection($this->subjects)

        ];
    }
}
