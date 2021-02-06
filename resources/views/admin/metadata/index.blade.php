@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.metadata.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Metadata">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.metadata.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.metadata.fields.setting') }}
                        </th>
                        <th>
                            {{ trans('cruds.metadata.fields.detail') }}
                        </th>
                        <th>
                            {{ trans('cruds.metadata.fields.detail_image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($metadata as $key => $metadata)
                        <tr data-entry-id="{{ $metadata->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $metadata->id ?? '' }}
                            </td>
                            <td>
                                {{ $metadata->setting ?? '' }}
                            </td>
                            <td>
                                {{ $metadata->detail ?? '' }}
                            </td>
                            <td>
                                @if($metadata->detail_image)
                                    <a href="{{ $metadata->detail_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $metadata->detail_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('metadata_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.metadata.show', $metadata->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('metadata_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.metadata.edit', $metadata->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-Metadata:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection