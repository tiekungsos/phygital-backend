@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.workCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.work-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="type_name">{{ trans('cruds.workCategory.fields.type_name') }}</label>
                <input class="form-control {{ $errors->has('type_name') ? 'is-invalid' : '' }}" type="text" name="type_name" id="type_name" value="{{ old('type_name', '') }}" required>
                @if($errors->has('type_name'))
                    <span class="text-danger">{{ $errors->first('type_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workCategory.fields.type_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="serch_tags">{{ trans('cruds.work.fields.serch_tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('serch_tags') ? 'is-invalid' : '' }}" name="serch_tags[]" id="serch_tags" multiple required>
                    @foreach($serch_tags as $id => $serch_tag)
                        <option value="{{ $id }}" {{ in_array($id, old('serch_tags', [])) ? 'selected' : '' }}>{{ $serch_tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('serch_tags'))
                    <span class="text-danger">{{ $errors->first('serch_tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.work.fields.serch_tag_helper') }}</span>
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