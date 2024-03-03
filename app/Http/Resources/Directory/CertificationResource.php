<?php

namespace App\Http\Resources\Directory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $campus = ($this->school->is_alone) ? $this->school->school->name : $this->school->school->name.' - '.$this->school->campus;
        return [
            'id' => $this->id,
            'years' => $this->years,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'course' => $this->course->shortcut,
            'school' => $campus,
            'certification' => $this->certification->name
        ];
    }
}
