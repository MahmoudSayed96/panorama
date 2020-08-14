<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required']
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
            'email.required' => 'البريد الإلكترونى مطلوب',
            'email.email' => 'بريد إالكترونى غير صحيح',
            'email.exists' => 'هذا البريد الإلكترونى غير مسجل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور المطلوبة اقل من :min',
            'password.confirmed' => 'كلمة المرور غير مطابقة'
        ];
    }
}
