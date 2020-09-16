<?php

namespace App\Http\Requests\Admin\Construction\Client;

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
            'client_phone' => ['required', 'unique:client_constructions', 'max:190'],
            'project_address' => ['required', 'max:190'],
            'paid_amount' => ['required', 'numeric'],
            'reaming_amount' => ['required', 'numeric'],
            'project_details' => [],
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
            'numeric' => 'هذا الحقل يجب ان يكون رقم',
            'min' => 'القيمة لا يجب ان تقل عن :min',
            'max' => 'القيمة لا يجب ان تزيد عن :max',
            'string' => 'القيمة يجب ان تكون احرف',
            'unique' => 'هذا الرقم موجود بالفعل',
            'photos.*.mimes' => 'الملف يجب ان يكون صورة بامتداد png,jpg,jpeg,gif',
            'photos.*.max' => 'الصورة يجب الاتكون اكبر من 2ميجا'
        ];
    }
}
