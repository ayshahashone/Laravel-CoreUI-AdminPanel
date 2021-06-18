<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('booking_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
            ],
        ];
    }
}
