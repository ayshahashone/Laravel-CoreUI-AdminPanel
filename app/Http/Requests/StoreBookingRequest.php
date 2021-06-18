<?php

namespace App\Http\Requests;
use App\Permission;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('booking_create');
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
