<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MarketRequest extends FormRequest
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
            'market_name'=>'required|max:50',
        ];
    }
    public function messages() {
        return [
        "required" => "必須項目です。",
        "market_name.max" => "50文字以内で入力してください。"
        ];
    }
    protected function failedValidation(Validator $validator) {
        $route= $this->route()->getName();
        switch ($route) {
            case '/create/markets':
                $validator->errors()->add('create_dialog', 'create_dialog');
                break;
                case '/update/markets':
                    $validator->errors()->add('update_dialog', 'update_dialog');
                break;
            }
        $this->merge(['validated' => 'true']);
        throw new HttpResponseException(
            redirect()->route('markets')->withInput()->withErrors($validator)
        );
    }
}
