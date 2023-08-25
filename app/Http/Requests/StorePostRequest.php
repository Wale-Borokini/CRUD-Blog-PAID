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
            'posting_plan_id' => 'required'
        ];
    }
    

    public function messages()
    {
        return [
            'country_id.required' => 'The Country field is required.',
            'state_id.required' => 'The State field is required.',
            'city_id.required' => 'The City field is required.',
            'posting_plan_id.required' => 'The Posting Plan field is required.'
                     
        ];
    }
}
