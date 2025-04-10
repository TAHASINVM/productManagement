<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'price'  => $this->price,
            'stock'  => $this->stock,
            'status' => $this->status == 1 ? 'Available' : 'Out of stock',
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
