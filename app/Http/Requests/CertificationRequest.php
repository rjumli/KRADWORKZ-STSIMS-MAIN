<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificationRequest extends FormRequest
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
            'years' => 'sometimes|required',
            'start_at' => 'sometimes|required',
            'end_at' => 'sometimes|required',
            'school_id' => [
                'sometimes',
                'required',
                function ($attribute, $value, $fail) {
                    $exists = \DB::table('school_courses')
                               ->where('school_id', $value)
                               ->where('course_id', request()->input('course_id'))
                               ->exists();
    
                    if ($exists) {
                        $fail('School and course already exists.');
                    }
                },
            ],
            'course_id' => [
                'sometimes',
                'required',
                function ($attribute, $value, $fail) {
                    $exists = \DB::table('school_courses')
                               ->where('course_id', $value)
                               ->where('school_id', request()->input('school_id'))
                               ->exists();
    
                    if ($exists) {
                        $fail('School and course already exists.');
                    }
                },
            ],
            'certification_id' => 'sometimes|required',
        ];
    }
}
