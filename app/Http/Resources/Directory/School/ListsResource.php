<?php

namespace App\Http\Resources\Directory\School;

use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $hashids = new Hashids('krad',10);

        return [
            'id' => $hashids->encode($this->id),
            'name' => $this->school->name.' '.$this->school->combiner.' '.strtoupper($this->campus),
            'address' => strtoupper($this->address.', '.$this->municipality->name.', '.$this->province->name.', '.$this->region->region.' '),
            'avatar' => $this->school->avatar,
            'term' => $this->term,
            'grading' => $this->grading,
            'assigned' => $this->assigned,
            'class' => ($this->school->class->name === 'SUC') ? ($this->is_main) ? $this->school->class->name.'-MAIN' : $this->school->class->name.'-SATELLITE' : $this->school->class->name

        ];
    }
}
