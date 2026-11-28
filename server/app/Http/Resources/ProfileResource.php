<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],

            'avatar' => $this->avatar,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'timezone' => $this->timezone,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
