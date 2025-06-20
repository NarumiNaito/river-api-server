<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWaterLevelRequest extends FormRequest
{
    public function authorize(): bool
        {
            return true; 
        }

        public function rules(): array
        {
            return [
                'min' => 'required|numeric|between:5,7',
                'max' => 'required|numeric|between:5,7|gt:min',
            ];
        }

        public function attributes()
        {
            return [
                'min' => '下限',
                'max' => '上限',
            ];
        }

        public function messages(): array
        {
            return [
                'min.required' => '下限を入力してください',
                'min.numeric' => '下限は数値で入力してください',
                'min.between' => '下限は5.00〜7.00の間で入力してください',

                'max.required' => '上限を入力してください',
                'max.numeric' => '上限は数値で入力してください',
                'max.between' => '上限は5.00〜7.00の間で入力してください',
                'max.gt' => '上限は下限より大きくしてください',
            ];
        }
}
