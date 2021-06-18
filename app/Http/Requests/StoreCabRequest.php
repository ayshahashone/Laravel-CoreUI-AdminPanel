<?php

namespace App\Http\Requests;
use App\Permission;
use Illuminate\Foundation\Http\FormRequest;

class StoreCabRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('cab_create');
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
