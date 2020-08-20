<?php

namespace App\Http\Requests\Admin\Offer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateOfferRequest extends FormRequest
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
            'product' => ['required', 'integer', 'exists:products,id'],
            'prod_owner' => ['required', 'string', 'min:3', 'max:190'],
            'prod_owner_phone' => ['required', 'max:190', Rule::unique('offers', 'prod_owner_phone')->ignore($this->id)],
            'prod_area' => ['required', 'numeric'],
            'prod_price' => ['required', 'numeric'],
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
            'exists' => 'هذا العنصر غير موجود',
            'unique' => 'هذا الرقم موجود بالفعل',
            'photos.*.mimes' => 'الملف يجب ان يكون صورة بامتداد png,jpg,jpeg,gif',
            'photos.*.max' => 'الصورة يجب الاتكون اكبر من 2ميجا'
        ];
    }
}
