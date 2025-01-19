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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'subscribed' => $this->subscribed(),
            'on_trial' => $this?->subscription()?->onTrial(),
            'trial_ends_at' => floor(now()->diffInDays($this?->subscription()?->trial_ends_at)),
            'subscription_canceled' => $this?->subscription()?->canceled(),
        ];
    }
}
