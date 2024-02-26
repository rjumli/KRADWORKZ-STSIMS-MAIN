<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'sometimes|required|max:200|unique:list_courses,name,'.$this->id,
            'shortcut' => 'sometimes|required|max:150|unique:list_courses,shortcut,'.$this->id,
            'abbreviation' => 'sometimes|required|string|max:50',
            'others' => 'sometimes|nullable|string|max:100'
        ];
    }
}
