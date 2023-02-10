<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class crequest extends FormRequest
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
            'client'=>'required|min:3|max:20',
            'soyad'=>'required|min:3|max:20',
            'telefon'=>'required|min:3|max:20',
            'email'=>'required|min:3|max:20',
            'sirket'=>'required|min:3|max:20',

        ];
    }
    
    public function messages()
    {
        return [
            'client.min'=>'client min 3 sinvol olmalidi!',
            'client.max'=>'client max 20 sinvol olmalidi!',
            'client.required'=>'client daxil etmediniz!',

            'soyad.min'=>'soyad min 3 sinvol olmalidi!',
            'soyad.max'=>'soyad max 20 sinvol olmalidi!',
            'soyad.required'=>'soyad daxil etmediniz!',

            'telefon.min'=>'telefon min 3 sinvol olmalidi!',
            'telefon.max'=>'telefon max 20 sinvol olmalidi!',
            'telefon.required'=>'telefon daxil etmediniz!',

            'email.min'=>'email min 3 sinvol olmalidi!',
            'email.max'=>'email max 20 sinvol olmalidi!',
            'email.required'=>'email daxil etmediniz!',

            'sirket.min'=>'sirket min 3 sinvol olmalidi!',
            'sirket.max'=>'sirket max 20 sinvol olmalidi!',
            'sirket.required'=>'sirket daxil etmediniz!',


        ];
    }
}
