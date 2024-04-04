<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required | string | max:20',
            'category_id' => 'required '
        ];
    }

    //メッセージの日本語化
    public function messages(){
        return[
            'content.required' => 'Todoを入力してください',
            'content.string' => 'Todoを文字列で入力してください',
            'content.max' => 'Todoを20文字以下で入力してください',
            'category_id.required' => 'カテゴリを入力してください',
            // 'category_id.string' => 'カテゴリを文字列で入力してください',
            // 'category_id.max' => 'カテゴリを10文字以下で入力してください',
            // 'category_id.unique' => 'カテゴリがすでに存在しています'
        ];
    }
}
