<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'campus' => 'sometimes|required',
            'address' => 'sometimes|required',
            'region_code' => 'sometimes|required',
            'province_code' => 'sometimes|required',
            'municipality_code' => 'sometimes|required',
            'term_id' => 'sometimes|required',
            'grading_id' => 'sometimes|required',
            'school_id' => 'sometimes|required',
            'assigned_region' => 'sometimes|required',
        ];
    }
}
