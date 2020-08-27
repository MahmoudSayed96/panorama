<?php

namespace App\Http\Requests\Admin\Decorations\CompanyDecoration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
            'client_name' => ['required', 'string', 'min:3', 'max:190'],
            'client_phone' => ['required', 'unique:company_decorations', 'max:190'],
            'paid_amount' => ['required', 'numeric'],
            'photos' => ['required'],
            'photos.*' => ['mimes:jpg,jpeg,png,gif', 'max:2096'],
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
            'required' => 'هذا الحقل مطلوب',
            'min' => 'القيمة لا يجب ان تقل عن :min',
            'max' => 'القيمة لا يجب ان تزيد عن :max',
            'numeric' => 'القيمة يجب ان تكون رقم',
            'string' => 'القيمة يجب ان تكون احرف',
            'unique' => 'هذا الرقم موجود بالفعل',
            'photos.*.mimes' => 'الملف يجب ان يكون صورة بامتداد png,jpg,jpeg,gif',
            'photos.*.max' => 'الصورة يجب الاتكون اكبر من 2ميجا'
        ];
    }
}
