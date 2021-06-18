@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.booking.title_singular') }} {{ trans('global.booking.fields.request') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.booking.fields.pickup address') }}
                    </th>
                    <td>
                        {{ $booking->from_location }}
                    </td>
                </tr>
                <tr>
                    <th>
                      {{ trans('global.booking.fields.dropoff address') }}
                    </th>
                    <td>
                        {!! $booking->to_location !!}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.booking.fields.request time') }}
                    </th>
                    <td>
                        {{ $booking->request_time }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.booking.fields.services') }}
                    </th>
                    <td>
                        {{ $booking->services }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection