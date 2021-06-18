@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.driver.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.driver.fields.name') }}
                    </th>
                    <td>
                        {{ $driver->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.driver.fields.description') }}
                    </th>
                    <td>
                        {!! $driver->address !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.driver.fields.price') }}
                    </th>
                    <td>
                        ${{ $driver->phoneno }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection