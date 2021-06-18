<?php

namespace App\Http\Requests;

use App\Driver;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyDriverRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('driver_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:drivers,id',
        ];
    }
}
