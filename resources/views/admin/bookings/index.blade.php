@extends('layouts.admin')
@section('content')
@can('booking_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bookings.create') }}">
                {{ trans('global.booking.fields.offline') }} {{ trans('global.booking.fields.booking') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.booking.title_singular') }} {{ trans('global.booking.fields.request') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.booking.fields.pickup address') }}
                        </th>
                        <th>
                            {{ trans('global.booking.fields.dropoff address') }}
                        </th>
                        <th>
                            {{ trans('global.booking.fields.request time') }}
                        </th>
                        <th>
                            {{ trans('global.booking.fields.services') }}
                        </th>
                        <th>
                            {{ trans('global.booking.fields.distance') }}
                        </th>
                        <th>
                            {{ trans('global.booking.fields.duration') }}
                        </th>
                        <th>
                            {{ trans('global.booking.fields.status') }}
                        </th>
                        
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $key => $booking)
                        <tr data-entry-id="{{ $booking->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $booking->from_location ?? '' }}
                            </td>
                            <td>
                                {{ $booking->to_location ?? '' }}
                            </td>
                            <td>
                                {{ $booking->request_time ?? '' }}
                            </td>
                            <td>
                                {{ $booking->services ?? '' }}
                            </td>
                            <td>
                                {{ $booking->distance ?? '' }}
                            </td>
                            <td>
                                {{ $booking->duration ?? '' }}
                            </td>
                            <td>
                                @if($booking->status == 'pending')
                                    <button type="button" class="btn btn-warning">{{ $booking->status ?? '' }}</button>
                                @elseif($booking->status == 'accept') 
                                    <button type="button" class="btn btn-success">{{ $booking->status ?? '' }}</button>
                                @else
                                    <button type="button" class="btn btn-danger">{{ $booking->status ?? '' }}</button>
                                @endif
                            </td>
                            <td>
                                @can('booking_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bookings.show', $booking->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('booking_edit')
                                    @if($booking->status == 'pending')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.bookings.edit', $booking->id) }}">
                                            {{ trans('global.confirm') }}
                                        </a>
                                    @endif    
                                @endcan
                               
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bookings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('booking_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection
@endsection