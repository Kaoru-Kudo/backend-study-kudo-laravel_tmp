<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'kana_name' => ['required', 'string', 'max:30', 'regex:/^[ァ-ロワンヴー]*$/u'],
            'sex_id' => ['required'],
            'birthday_year' => ['required'],
            'birthday_month' => ['required'],
            'birthday_day' => ['required'],
            'phone' => ['required', 'regex:/^0(\\d-?\\d{4}|\\d{2}-?\\d{3}|\\d{3}-?\\d{2}|\\d{4}-?\\d|\\d0-?\\d{4})-?\\d{4}$/'],
            'job_prefecture_id' => ['required'],
            'job_type_id' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'body' => ['required', 'string', 'max:5000'],
        ];
    }

    /**
     * 属性名
     */
    public function attributes()
    {
        //
        return [
            'name' => '名前',
            'kana_name' => 'フリガナ',
            'sex_id' => '性別',
            'birthday_year' => '生年月日（年）',
            'birthday_month' => '生年月日（月）',
            'birthday_day' => '生年月日（日）',
            'phone' => '電話番号',
            'job_prefecture_id' => '希望勤務地',
            'job_type_id' => '希望職種',
            'email' => 'メールアドレス',
            'body' => 'お問い合わせ内容',
        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages()
    {
        //
        return [
            // 'phone.regex' => ':attributeが正しくありません。',
        ];
    }
}
