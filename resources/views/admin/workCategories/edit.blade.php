@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.workCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.work-categories.update", [$workCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="type_name">{{ trans('cruds.workCategory.fields.type_name') }}</label>
                <input class="form-control {{ $errors->has('type_name') ? 'is-invalid' : '' }}" type="text" name="type_name" id="type_name" value="{{ old('type_name', $workCategory->type_name) }}" required>
                @if($errors->has('type_name'))
                    <span class="text-danger">{{ $errors->first('type_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workCategory.fields.type_name_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection