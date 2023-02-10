<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class prequest extends FormRequest
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
            'brand_id'=>'required',
            'mehsul'=>'required|min:3|max:20',
            'alish'=>'required',
            'satish'=>'required',
            'miqdar'=>'required',


        ];
    }
    
    public function messages()
    {
        return [
            
            'brand_id.required'=>'brand_id daxil etmediniz!',

            'mehsul.min'=>'mehsul min 3 sinvol olmalidi!',
            'mehsul.max'=>'mehsul max 20 sinvol olmalidi!',
            'mehsul.required'=>'mehsul daxil etmediniz!',

            'alish.required'=>'alish daxil etmediniz!',

            'satish.required'=>'satish daxil etmediniz!',

            'miqdar.required'=>'miqdar daxil etmediniz!',

            


        ];
    }
}
