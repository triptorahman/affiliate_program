<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubAffiliateAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
     
       
        return [
           
            
            'name' => 'required|max:100',
            'email' => 'required|email|unique:affiliates,email',
            // 'code' => 'required|max:20|unique:affiliates,code',
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            
            'email.required' => 'The email  field is required.',
            
        ];
    }
}
