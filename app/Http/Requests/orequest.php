<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {       
        return [
            'product_id'=>'required',
            'client_id'=>'required',
            'sifarish'=>'required|numeric',


        ];
    }
    
    public function messages()
    {
        return [
            
            'product_id.required'=>'product_id daxil etmediniz!',

            'client_id.required'=>'client_id daxil etmediniz!',

            'sifarish.required'=>'sifarish daxil etmediniz!',

            


        ];

    }
}
