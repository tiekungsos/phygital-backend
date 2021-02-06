@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.metadata.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.metadata.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="setting">{{ trans('cruds.metadata.fields.setting') }}</label>
                <input class="form-control {{ $errors->has('setting') ? 'is-invalid' : '' }}" type="text" name="setting" id="setting" value="{{ old('setting', '') }}">
                @if($errors->has('setting'))
                    <span class="text-danger">{{ $errors->first('setting') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.metadata.fields.setting_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="detail">{{ trans('cruds.metadata.fields.detail') }}</label>
                <textarea class="form-control {{ $errors->has('detail') ? 'is-invalid' : '' }}" name="detail" id="detail">{{ old('detail') }}</textarea>
                @if($errors->has('detail'))
                    <span class="text-danger">{{ $errors->first('detail') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.metadata.fields.detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="detail_image">{{ trans('cruds.metadata.fields.detail_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('detail_image') ? 'is-invalid' : '' }}" id="detail_image-dropzone">
                </div>
                @if($errors->has('detail_image'))
                    <span class="text-danger">{{ $errors->first('detail_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.metadata.fields.detail_image_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.detailImageDropzone = {
    url: '{{ route('admin.metadata.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="detail_image"]').remove()
      $('form').append('<input type="hidden" name="detail_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="detail_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($metadata) && $metadata->detail_image)
      var file = {!! json_encode($metadata->detail_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="detail_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection