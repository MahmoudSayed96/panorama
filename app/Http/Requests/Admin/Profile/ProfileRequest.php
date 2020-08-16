<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:190'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(currentUser()->id)],
            'photo' => ['image', 'mimes:jpeg,jpg,png']
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
            'email.required' => 'البريد الإلكترونى مطلوب',
            'email.email' => 'بريد إالكترونى غير صحيح',
            'email.unique' => 'بريد إالكترونى موجود بالفعل',
            'photo.image' => 'الصورة غير صحيحة',
            'photo.mimes' => 'الصورة غير صحيحة'
        ];
    }
}
