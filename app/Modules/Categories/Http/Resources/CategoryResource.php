<?php

namespace App\Modules\Categories\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'group' => new GroupResource($this->whenLoaded('group')),
            'childs' => ChildCategoryResource::collection($this->whenLoaded('childs')),
        ];
    }
}
