<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCabRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('cab_edit');
    }

    public function rules()
    {
        return [
            'cabno' => [
                'required',
            ],
        ];
    }
}
