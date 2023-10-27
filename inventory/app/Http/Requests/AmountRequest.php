<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AmountRequest extends FormRequest
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
            'seasoning_amount'=>'nullable|numeric|max:999999'
        ];
    }
    public function messages() {
        return [
        "seasoning_amount.max" => "100万円以上の金額は登録できません。",
        "seasoning_amount.numeric" => "半角数字で入力してください。",
        ];
      }
    protected function failedValidation(Validator $validator) {
        $route= $this->route()->getName();
        switch ($route) {
            case 'amount/upsert':
                $validator->errors()->add('upsert_dialog', 'upsert_dialog');
                break;
        }
        $this->merge(['validated' => 'true']);
        throw new HttpResponseException(
            redirect()->route('index')->withInput()->withErrors($validator)
        );
    }
}
