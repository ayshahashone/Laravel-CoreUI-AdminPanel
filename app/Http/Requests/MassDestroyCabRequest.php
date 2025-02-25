<?php

namespace App\Http\Requests;

use App\Cab;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyCabRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('cab_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cabs,id',
        ];
    }
}
