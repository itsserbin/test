<?php

namespace App\Http\Resources;

use App\Traits\QueryDataResourcesTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    use QueryDataResourcesTrait;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    final public function toArray(Request $request): array
    {
        return [
            ...$this->selectQuery($request->get('select')),
            ...$this->withQuery($request->get('with')),
            'id' => $this->resource->id,
        ];
    }
}
