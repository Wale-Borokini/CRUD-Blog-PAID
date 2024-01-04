<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [           
            'post_title' => 'required',
            'post_description' => 'required',            
            'age' => 'required|integer',    
            'name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'gender_id' => 'nullable|integer|max:20',
            'ethnicity_id' => 'nullable|integer|max:20',
            'hair_id' => 'nullable|integer|max:20',
            'eye_id' => 'nullable|integer|max:20',
            'height' => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',        
        ];
    }
    
}
