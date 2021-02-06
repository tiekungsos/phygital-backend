@extends('layouts.admin')
@section('content')
@can('growup_blog_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.growup-blogs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.growupBlog.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.growupBlog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-GrowupBlog">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.growupBlog.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.growupBlog.fields.blog_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.growupBlog.fields.name_write') }}
                        </th>
                        <th>
                            {{ trans('cruds.growupBlog.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.growupBlog.fields.type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($growupBlogs as $key => $growupBlog)
                        <tr data-entry-id="{{ $growupBlog->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $growupBlog->id ?? '' }}
                            </td>
                            <td>
                                {{ $growupBlog->blog_name ?? '' }}
                            </td>
                            <td>
                                {{ $growupBlog->name_write ?? '' }}
                            </td>
                            <td>
                                @if($growupBlog->image)
                                    <a href="{{ $growupBlog->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $growupBlog->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($growupBlog->types as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('growup_blog_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.growup-blogs.show', $growupBlog->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('growup_blog_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.growup-blogs.edit', $growupBlog->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('growup_blog_delete')
                                    <form action="{{ route('admin.growup-blogs.destroy', $growupBlog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('growup_blog_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.growup-blogs.massDestroy') }}",
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
  let table = $('.datatable-GrowupBlog:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection