<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormPage1SessionRequest extends FormRequest
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
            'usage_situation' => ['integer',Rule::in([1, 2, 3])],
        ];
    }

    public function attributes()
    {
        return [
            'usage_situation' => '住宅ローンの利用有無',
        ];
    }
}
