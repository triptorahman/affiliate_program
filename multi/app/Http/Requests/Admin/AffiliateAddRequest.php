<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AffiliateAddRequest extends FormRequest
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
        // dd($this->request);
       
        return [
            // 'year' => 'required|unique:our_storys',
            
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
