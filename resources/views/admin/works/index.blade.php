@extends('layouts.admin')
@section('content')
@can('work_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.works.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.work.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.work.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Work">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.work.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.work.fields.name_work') }}
                        </th>
                        <th>
                            {{ trans('cruds.work.fields.type_of_work') }}
                        </th>
                        <th>
                            {{ trans('cruds.work.fields.clients') }}
                        </th>
                        <th>
                            {{ trans('cruds.work.fields.header_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.work.fields.all_work_image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($works as $key => $work)
                        <tr data-entry-id="{{ $work->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $work->id ?? '' }}
                            </td>
                            <td>
                                {{ $work->name_work ?? '' }}
                            </td>
                            <td>
                                @foreach($work->type_of_works as $key => $item)
                                    <span class="badge badge-info">{{ $item->type_name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $work->clients->name ?? '' }}
                            </td>
                            <td>
                                @if($work->header_image)
                                    <a href="{{ $work->header_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $work->header_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($work->all_work_image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('work_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.works.show', $work->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('work_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.works.edit', $work->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('work_delete')
                                    <form action="{{ route('admin.works.destroy', $work->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('work_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.works.massDestroy') }}",
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
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Work:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection