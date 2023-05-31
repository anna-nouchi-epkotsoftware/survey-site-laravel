<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormPage2SessionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'financial_institution1' => 'boolean | required_without_all:financial_institution2,financial_institution3,financial_institution4',
            'financial_institution2' => 'boolean',
            'financial_institution3' => 'boolean',
            'financial_institution4' => 'boolean',
        ];
    }
    public function attributes()
    {
        return [
            'financial_institution1' => '住宅金融公庫',
            'financial_institution2' => '地方銀行',
            'financial_institution3' => 'みずほ銀行',
            'financial_institution4' => 'その他',
        ];
    }
    public function messages()
    {
        return [
            'financial_institution1.required_without_all' => 'どれかひとつは選択してください。',
        ];
    }
}
