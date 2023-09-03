<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'country_id' => 'required',            
            'state_id' => 'required',
            'city_id' => 'required',
            'post_title' => 'required',
            'post_description' => 'required',
            'name' => 'required',
            'age' => 'required',
            'posting_plan_id' => 'required',
            'image_url' => 'array|max:4',
            'image_url.*' => 'image|mimes:jpeg,png,jpg,gif|max:15048',
        ];
    }
    

    public function messages()
    {
        return [
            'country_id.required' => 'The Country field is required.',
            'state_id.required' => 'The State field is required.',
            'city_id.required' => 'The City field is required.',
            'posting_plan_id.required' => 'The Posting Plan field is required.',
            'image_url.array' => 'Please upload images.',
            'image_url.max' => 'You can upload a maximum of 4 images.',
            'image_url.*.image' => 'Please upload a valid image.',
            'image_url.*.mimes' => 'The image must be a JPEG, PNG, JPG, or GIF.',
            'image_url.*.max' => 'The image size must not exceed 15 MB.',
                     
        ];
    }
}
