<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if($this->type == 'region'){
            return [
                'code' => 'required|unique:location_regions',
                'name' => 'required|unique:location_regions|max:255',
                'region' => 'sometimes|required',
                'island' => 'sometimes|required',
            ];
        }else if($this->type == 'province'){
            return [
                'code' => 'required|unique:location_provinces',
                'name' => 'required|unique:location_provinces|max:255',
                'region' => 'sometimes|required',
                'old_name' => 'sometimes|nullable',
            ];
        }else if($this->type == 'municipality'){
            return [
                'code' => 'required|unique:location_municipalities',
                'name' => 'required|unique:location_municipalities|max:255',
                'province' => 'sometimes|required',
                'zip_code' => 'sometimes|nullable',
                'district' => 'sometimes|nullable',
                'old_name' => 'sometimes|nullable',
            ];
        }else if($this->type == 'barangay'){
            return [
                'code' => 'required|unique:location_barangays',
                'name' => 'required|unique:location_barangays|max:255',
                'municipality' => 'sometimes|required',
                'district' => 'sometimes|nullable',
                'old_name' => 'sometimes|nullable',
            ];
        }
    }
}
