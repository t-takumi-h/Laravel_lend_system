<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'part_num' => ['required', 'string', 'max:255'],
            'vendor' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'integer'],
        ];
    }

    public function attributes()
    {
        return [
            'name'      => '備品名',
            'part_num'  => '型名',
            'vendor'    => 'メーカー名',
            'category'  => 'カテゴリ',
        ];
    }
}
