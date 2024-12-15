<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MajorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id  ,
            'nameMajor'=>$this->name ,
            'imageMajor'=>$this->image ,
            'doctor'=>DoctorResource::collection($this->users)
        ];
    }
}
