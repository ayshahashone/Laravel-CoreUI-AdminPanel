@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.cab.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.cabs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('cabno') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.cab.fields.cabno') }}*</label>
                <input type="text" id="cabno" name="cabno" class="form-control" value="{{ old('cabno', isset($cab) ? $cab->cabno : '') }}">
                @if($errors->has('cabno'))
                    <em class="invalid-feedback">
                        {{ $errors->first('cabno') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
                <label for="model">{{ trans('global.cab.fields.model') }}</label>
                <input type="text" id="model" name="model" class="form-control" value="{{ old('model', isset($cab) ? $cab->model : '') }}">
                @if($errors->has('model'))
                    <em class="invalid-feedback">
                        {{ $errors->first('model') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('cabtype') ? 'has-error' : '' }}">
                <label for="cabtype">{{ trans('global.cab.fields.cabtype') }}</label>
                <input type="text" id="cabtype" name="cabtype" class="form-control" value="{{ old('cabtype', isset($cab) ? $cab->cabtype : '') }}" >
                @if($errors->has('cabtype'))
                    <em class="invalid-feedback">
                        {{ $errors->first('cabtype') }}
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