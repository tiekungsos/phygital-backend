@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.metadata.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.metadata.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.metadata.fields.id') }}
                        </th>
                        <td>
                            {{ $metadata->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.metadata.fields.setting') }}
                        </th>
                        <td>
                            {{ $metadata->setting }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.metadata.fields.detail') }}
                        </th>
                        <td>
                            {{ $metadata->detail }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.metadata.fields.detail_image') }}
                        </th>
                        <td>
                            @if($metadata->detail_image)
                                <a href="{{ $metadata->detail_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $metadata->detail_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.metadata.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection