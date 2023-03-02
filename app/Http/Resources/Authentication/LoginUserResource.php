<?php

namespace App\Http\Resources\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class LoginUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->createToken('auth_token')->plainTextToken,
            'user'  => [
                'id'        => $this->id,
                'full_name' => $this->full_name,
                'email'     => $this->email,
            ]
        ];
    }
}
