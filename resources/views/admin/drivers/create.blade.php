@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.driver.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.driver.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($driver) ? $driver->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.driver.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address">{{ trans('global.driver.fields.address') }}</label>
                <textarea id="address" name="address" class="form-control ">{{ old('address', isset($driver) ? $driver->address : '') }}</textarea>
                @if($errors->has('address'))
                    <em class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.driver.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phoneno') ? 'has-error' : '' }}">
                <label for="phoneno">{{ trans('global.driver.fields.phoneno') }}</label>
                <input type="text" id="phoneno" name="phoneno" class="form-control" value="{{ old('phoneno', isset($driver) ? $driver->phoneno : '') }}" >
                @if($errors->has('phoneno'))
                    <em class="invalid-feedback">
                        {{ $errors->first('phoneno') }}
                    </em>
                @endif
                
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection