<?php

namespace App\Modules\Accounts\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => new TypeResource($this->whenLoaded('type')),
            'currency' => $this->currency,
            'conversion_rate' => $this->conversion_rate,
            'cash_based_account' => $this->cash_based_account,
        ];
    }
}
