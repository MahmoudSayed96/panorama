<?php

namespace App\Http\Requests\Admin\Investments\Premium;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePremiumRequest extends FormRequest
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
        $todayDate = date('Y-m-d');

        return [
            'client_name' => ['required', 'string', 'max:190'],
            'client_phone' => ['required', Rule::unique('premia', 'client_phone')->ignore($this->id), 'max:190'],
            'details' => [],
            'alqist_amount' => ['required', 'numeric'],
            'remaining_amount' => ['required', 'numeric'],
            'end_amount_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:' . $todayDate],
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
            'numeric' => 'هذا الحقل يجب ان يكون ارقام',
            'unique' => 'هذا الرقم موجود بالفعل',
            'exists' => 'هذا المنتج غير مسجل',
            'max' => 'هذا الحقل يجب الا يزيد عن :max حرف',
            'date_format' => 'قم بادخال تاريخ صحيح',
            'after_or_equal' => 'قم بادخال تاريخ قادم',
        ];
    }
}
