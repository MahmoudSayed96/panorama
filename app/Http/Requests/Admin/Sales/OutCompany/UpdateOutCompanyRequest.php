<?php

namespace App\Http\Requests\Admin\Sales\OutCompany;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateOutCompanyRequest extends FormRequest
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
            'buyer_phone' => ['required', Rule::unique('out_company_sales', 'buyer_phone')->ignore($this->id), 'max:190'],
            'wasit' => ['required', 'in:1,0'],
            'indication' => [],
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
            'max' => 'هذا الحقل يجب الا يزيد عن :max حرف',
            'in' => 'هذة القيمة خطأ'
        ];
    }
}
