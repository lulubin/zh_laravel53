<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'content.required' => '内容不能为空',
            'content.min' => '回答至少10个字符',
        ];
    }

    public function rules()
    {
        return [
            'content' => 'required|min:10'
        ];
    }
}
