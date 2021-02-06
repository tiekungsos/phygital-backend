@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.work.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.works.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.id') }}
                        </th>
                        <td>
                            {{ $work->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.name_work') }}
                        </th>
                        <td>
                            {{ $work->name_work }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.type_of_work') }}
                        </th>
                        <td>
                            @foreach($work->type_of_works as $key => $type_of_work)
                                <span class="label label-info">{{ $type_of_work->type_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.clients') }}
                        </th>
                        <td>
                            {{ $work->clients->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.work_detail') }}
                        </th>
                        <td>
                            {!! $work->work_detail !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.header_image') }}
                        </th>
                        <td>
                            @if($work->header_image)
                                <a href="{{ $work->header_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $work->header_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.all_work_image') }}
                        </th>
                        <td>
                            @foreach($work->all_work_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.works.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection