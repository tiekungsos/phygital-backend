@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.growupBlog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.growup-blogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.growupBlog.fields.id') }}
                        </th>
                        <td>
                            {{ $growupBlog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.growupBlog.fields.blog_name') }}
                        </th>
                        <td>
                            {{ $growupBlog->blog_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.growupBlog.fields.name_write') }}
                        </th>
                        <td>
                            {{ $growupBlog->name_write }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.growupBlog.fields.image') }}
                        </th>
                        <td>
                            @if($growupBlog->image)
                                <a href="{{ $growupBlog->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $growupBlog->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.growupBlog.fields.type') }}
                        </th>
                        <td>
                            @foreach($growupBlog->types as $key => $type)
                                <span class="label label-info">{{ $type->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.growupBlog.fields.detail') }}
                        </th>
                        <td>
                            {!! $growupBlog->detail !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.growup-blogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection