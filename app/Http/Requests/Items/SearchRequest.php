<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'search' => ['max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'search'    => '検索欄',
        ];
    }
}
