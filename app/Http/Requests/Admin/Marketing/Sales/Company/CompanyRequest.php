<?php

namespace App\Http\Requests\Admin\Marketing\Sales\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompanyRequest extends FormRequest
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
            'product' => ['required', 'exists:products,id', 'numeric'],
            'buyer_name' => ['required', 'string', 'max:190'],
            'buyer_phone' => ['required', 'unique:company_sales', 'max:190'],
            'price' => ['required'],
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
            'string' => 'هذا الحقل يجب ان يكون احرف',
            'unique' => 'هذا الرقم موجود بالفعل',
            'exists' => 'هذا المنتج غير مسجل',
            'max' => 'هذا الحقل يجب الا يزيد عن :max حرف'
        ];
    }
}
