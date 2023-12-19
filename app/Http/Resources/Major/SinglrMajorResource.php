<?php

namespace App\Http\Resources\Major;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SinglrMajorResource extends JsonResource
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
            'title' => $this->title,
            'image' => $this->image,
            'doctors' => $this->doctors->map(function ($x) {
                return [
                    'id' => $x->id,
                    'name' => $x->name,
                    'bio' => $x->bio ?? 'no data',
                    'image' => asset('front/assets/images/' . $x->image),
                ];
            })
        ];
    }
}
