<?php

namespace App\Http\Requests;

use App\BookingRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyBookingRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('booking_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bookings,id',
        ];
    }
}
