<?php
 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class brequest extends FormRequest
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
            'brand'=>'required|min:3|max:20',
            
        ];
    }
 
    public function messages()
    {
        return [
            'brand.min'=>'brand min 3 sinvol olmalidi!',
            'brand.max'=>'brand max 20 sinvol olmalidi!',
            'brand.required'=>'brand daxil etmediniz!',

        ];
    }
        
}

