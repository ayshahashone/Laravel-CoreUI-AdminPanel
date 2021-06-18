@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
         {{ trans('global.booking.title_singular') }} {{ trans('global.booking.fields.request') }} 
    </div>

    <div class="card-body">
        <form action="{{ route("admin.bookings.update", [$booking->id]) }}"  method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
           


            <div class="form-group">
                <label for="status">{{ trans('global.booking.fields.status') }}</label>
                <!--  Select Status -->
                <select class="form-control" id="status" name="status" required>
                    <option value=""> Select Status </option>
                    <option value="accept" > Accept </option>
                    <option value="reject" > Reject </option>
                </select>
                <!-- Unselect Status -->
            </div>

            <!------------------------------------------>
            <!--          Driver Information          -->
            <!------------------------------------------>
            <div id="row_dim">
                <div class="form-group">
                    <label for="drivers">{{ trans('global.booking.fields.driver') }}</label>
                    <!-- Select Drivers -->
                    <select class="form-control" id="driverid" name="driver_id" required>
                        <option value="" > Select Driver </option>
                        @foreach($drivers as $driver)
                            <option value="{{$driver->id}}"> {{ $driver->name }}   </option>
                        @endforeach
                    </select>
                    <!-- Unselect Drivers -->
                </div>
            <!-- Cab Information -->
                <div class="form-group">
                    <label for="cabs">{{ trans('global.booking.fields.cab') }}</label>
                    <!-- Select Drivers -->
                    <select class="form-control" id="cabid" name="cab_id" required>
                        <option value="" > Select Cab </option>
                        @foreach($cabs as $cab)
                            <option value="{{$cab->id}}"> {{ $cab->no }}  {{ $cab->model }} {{ $cab->cabtype }} </option>
                        @endforeach
                    </select>
                    <!-- Unselect Cabs -->
                </div>
            </div>
             
             <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                <input type="hidden" id="userid" name="user_id" class="form-control" readonly value="{{ old('user_id', isset($booking) ? $booking->user_id : '') }}">
                @if($errors->has('user_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('user_id') }}
                    </em>
                @endif
            </div>

            <!--------------->
            <!------------------------------------------>
            <!--  Extra user information for display  -->
            <!------------------------------------------>

            <div class="form-group">
                <label for="clientname">{{ trans('global.booking.fields.client name') }}</label>
                <input type="text" id="clientname"  class="form-control" readonly value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="clientemail">{{ trans('global.booking.fields.client email') }}</label>
                <input type="text" id="clientemail"  class="form-control" readonly value="{{$user->email}}">
            </div>



            <!-- From Location -->
            <div class="form-group {{ $errors->has('from_location') ? 'has-error' : '' }}">
                <label for="fromlocation">{{ trans('global.booking.fields.pickup address') }}*</label>
                <input type="text" id="fromlocation" name="pickup_address" class="form-control" readonly value="{{ old('from_location', isset($booking) ? $booking->from_location : '') }}">
                @if($errors->has('from_location'))
                    <em class="invalid-feedback">
                        {{ $errors->first('from_location') }}
                    </em>
                @endif
            </div>
            <!-- To Location -->
            <div class="form-group {{ $errors->has('to_location') ? 'has-error' : '' }}">
                <label for="tolocation">{{ trans('global.booking.fields.dropoff address') }}</label>
                <input type="text" id="tolocation" name="dropoff_address" class="form-control" readonly value="{{ old('to_location', isset($booking) ? $booking->to_location : '') }}">
                @if($errors->has('to_location'))
                    <em class="invalid-feedback">
                        {{ $errors->first('to_location') }}
                    </em>
                @endif
            </div>
            <!-- Services -->
            <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                <label for="services">{{ trans('global.booking.fields.services') }}</label>
                <input type="text" id="services" name="services" class="form-control" readonly value="{{ old('services', isset($booking) ? $booking->services : '') }}">
                @if($errors->has('services'))
                    <em class="invalid-feedback">
                        {{ $errors->first('services') }}
                    </em>
                @endif
            </div>
            <!-- Request Time -->
            <div class="form-group {{ $errors->has('request_time') ? 'has-error' : '' }}">
                <label for="requesttime">{{ trans('global.booking.fields.request time') }}</label>
                <input type="text" id="requesttime" name="request_time" class="form-control" readonly value="{{ old('request_time', isset($booking) ? $booking->request_time : '') }}">
                @if($errors->has('request_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('request_time') }}
                    </em>
                @endif
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    /* jquery function related to booking request */
    $(function() {
        $('#row_dim').hide(); 
        $('#status').change(function(){
            if($('#status').val() == 'accept') {
                $('#row_dim').show(); 
                $('#driverid').prop('required',true);
                $('#cabid').prop('required',true);
            } else {
                $('#row_dim').hide(); 
                $('#driverid').prop('required',false);
                $('#cabid').prop('required',false);
            } 
        });
    });
</script>

@endsection