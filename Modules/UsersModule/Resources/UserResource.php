<?php

namespace Modules\UsersModule\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->id,
            'user_email' => $this->email,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'source' => $this->source
        ];
    }
}
