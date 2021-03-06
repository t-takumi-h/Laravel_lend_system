<?php

namespace App\Http\Requests\LendLogs;

use Illuminate\Foundation\Http\FormRequest;

class LendLogRequest extends FormRequest
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
            'return_expect' => ['required', 'date', 'after_or_equal:today'],
        ];
    }

    public function attributes()
    {
        return [
            'return_expect' => '返却予定日',
        ];
    }
}
