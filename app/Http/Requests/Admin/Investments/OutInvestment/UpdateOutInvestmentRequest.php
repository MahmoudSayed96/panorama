<?php

namespace App\Http\Requests\Admin\Investments\OutInvestment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateOutInvestmentRequest extends FormRequest
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
            'client_name' => ['required', 'string', 'max:190'],
            'client_phone' => ['required', 'max:190'],
            'client_photo' => ['image', 'mimes:jpg,jpeg,png,gif', 'max:2096'],
            'income_details' => [],
            'paid_amount' => ['required', 'numeric'],
            'total_amount' => ['required', 'numeric'],
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
            'mimes' => 'الملف يجب ان يكون صورة بامتداد png,jpg,jpeg,gif',
            'client_photo.max' => 'الصورة يجب الاتكون اكبر من 2ميجا',
            'image' => 'قم باختيار صورة',
        ];
    }
}
