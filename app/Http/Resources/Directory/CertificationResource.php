<?php

namespace App\Http\Resources\Directory;

use Carbon\Carbon;
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
        $endAt = Carbon::parse($this->end_at);
        return [
            'id' => $this->id,
            'years' => $this->years,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'validity' => $endAt->diffInDays(Carbon::now()).' days',
            'course' => $this->course->shortcut,
            'school' => $campus,
            'is_active' => $this->is_active,
            'certification' => $this->certification->name
        ];
    }
}
