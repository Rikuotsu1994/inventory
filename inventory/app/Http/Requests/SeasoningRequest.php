<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SeasoningRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'seasoning_name'=>'required|max:50',
            'seasoning_inventory'=>'nullable|numeric|max:99',
            'remarks'=>'nullable|max:100',
            'seasoning_image'=>'nullable|mimes:jpg,jpeg,png|max:1024'
        ];
    }
    public function messages() {
        return [
        "required" => "必須項目です。",
        "seasoning_name.max" => "50文字以内で入力してください。",
        "seasoning_inventory.max" => "登録できる在庫数は99個までです。",
        "remarks.max" => "100文字以内で入力してください。",
        "mimes"=> "画像はjpeg・png・jpgのみアップロードできます。",
        "seasoning_image.max"=> "画像のサイズが1MBを超えています。"
        ];
      }
    protected function failedValidation(Validator $validator) {
        $route= $this->route()->getName();
        switch ($route) {
            case 'create':
                $validator->errors()->add('dialog_name', 'create_dialog');
                break;
        }
        $this->merge(['validated' => 'true']);
        throw new HttpResponseException(
            redirect()->route('index')->withInput()->withErrors($validator)
        );
    }
}
