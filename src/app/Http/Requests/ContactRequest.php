<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'last_name'       => 'required',
            'first_name'      => 'required',
            'gender'          => 'required',
            'email'           => 'required|email',
            'tel1'            => 'required|digits_between:3,5',
            'tel2'            => 'required|digits_between:3,5',
            'tel3'            => 'required|digits_between:3,5',
            'address'         => 'required',
            'building'        => ['nullable', 'string', 'max:100'],
            'category_id'     => 'required',
            'message'         => 'required|max:120',
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'tel1.required'         => '電話番号を入力してください',
            'tel1.digits_between'            => '電話番号は3桁から5桁の数字で入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'message.required'     => 'お問い合わせ内容を入力してください',
            'message.max'          => 'お問合せ内容は120文字以内で入力してください',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
    
}
