@extends('layouts.admin')
@section('content')
@can('cab_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cabs.create') }}">
                {{ trans('global.add') }} {{ trans('global.cab.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.cab.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.cab.fields.cabno') }}
                        </th>
                        <th>
                            {{ trans('global.cab.fields.model') }}
                        </th>
                        <th>
                            {{ trans('global.cab.fields.cabtype') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cabs as $key => $cab)
                        <tr data-entry-id="{{ $cab->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cab->cabno ?? '' }}
                            </td>
                            <td>
                                {{ $cab->model ?? '' }}
                            </td>
                            <td>
                                {{ $cab->cabtype ?? '' }}
                            </td>
                            <td>
                                @can('cab_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cabs.show', $cab->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('cab_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cabs.edit', $cab->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('cab_delete')
                                    <form action="{{ route('admin.cabs.destroy', $cab->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
    url: "{{ route('admin.cabs.massDestroy') }}",
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
@can('driver_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection
@endsection