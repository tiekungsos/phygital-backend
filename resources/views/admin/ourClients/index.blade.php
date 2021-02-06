@extends('layouts.admin')
@section('content')
@can('our_client_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.our-clients.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ourClient.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ourClient.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-OurClient">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ourClient.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.ourClient.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.ourClient.fields.logo_company') }}
                        </th>
                        <th>
                            {{ trans('cruds.ourClient.fields.logl_bw') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ourClients as $key => $ourClient)
                        <tr data-entry-id="{{ $ourClient->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ourClient->id ?? '' }}
                            </td>
                            <td>
                                {{ $ourClient->name ?? '' }}
                            </td>
                            <td>
                                @if($ourClient->logo_company)
                                    <a href="{{ $ourClient->logo_company->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $ourClient->logo_company->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($ourClient->logl_bw)
                                    <a href="{{ $ourClient->logl_bw->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $ourClient->logl_bw->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('our_client_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.our-clients.show', $ourClient->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('our_client_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.our-clients.edit', $ourClient->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('our_client_delete')
                                    <form action="{{ route('admin.our-clients.destroy', $ourClient->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('our_client_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.our-clients.massDestroy') }}",
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
  let table = $('.datatable-OurClient:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection