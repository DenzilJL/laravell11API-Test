<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'address' => $this->address,
            'status' => $this->status,
            'pincode' => $this->pincode,
            'createdAt' => $this->created_at,
            'UpdatedAt' => $this->updated_at,
            'rememberToken' => $this->remember_token,
        ];
    }
}
