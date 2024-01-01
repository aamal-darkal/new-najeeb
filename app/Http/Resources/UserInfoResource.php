<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'name' => $this->student->first_name .''. $this->student->last_name,
                'username' => $this->user_name,
                'user_type' => 'student',
                'photo' => $this->student->photo,
                'imageUrl' => $this->student->photo,
                'phone' => $this->student->phone,
                'api_token' => $this->token ,
                'date_token' => $this->token_birth,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
    }
}
