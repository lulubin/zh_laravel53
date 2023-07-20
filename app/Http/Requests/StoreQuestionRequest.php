<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.min' => '标题至少3个字符',
            'title.max' => '标题最多3个字符',
            'content.required' => '内容不能为空',
            'content.min' => '内容至少20个字符',
        ];
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:196',
            'content' => 'required|min:20'
        ];
    }
}
