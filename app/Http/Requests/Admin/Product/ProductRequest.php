<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:products', 'min:3', 'max:190']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.min' => 'الاسم المطلوب يجب الا يقل عن :min احرف',
            'name.max' => 'الاسم المطلوب يجب الا يزيد عن :max احرف',
            'name.unique' => 'هذا الاسم موجود بالفعل',
        ];
    }
}
