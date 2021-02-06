@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ourClient.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.our-clients.update", [$ourClient->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.ourClient.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $ourClient->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ourClient.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="logo_company">{{ trans('cruds.ourClient.fields.logo_company') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo_company') ? 'is-invalid' : '' }}" id="logo_company-dropzone">
                </div>
                @if($errors->has('logo_company'))
                    <span class="text-danger">{{ $errors->first('logo_company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ourClient.fields.logo_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="logl_bw">{{ trans('cruds.ourClient.fields.logl_bw') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logl_bw') ? 'is-invalid' : '' }}" id="logl_bw-dropzone">
                </div>
                @if($errors->has('logl_bw'))
                    <span class="text-danger">{{ $errors->first('logl_bw') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ourClient.fields.logl_bw_helper') }}</span>
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
    Dropzone.options.logoCompanyDropzone = {
    url: '{{ route('admin.our-clients.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 80,
      height: 80
    },
    success: function (file, response) {
      $('form').find('input[name="logo_company"]').remove()
      $('form').append('<input type="hidden" name="logo_company" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo_company"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($ourClient) && $ourClient->logo_company)
      var file = {!! json_encode($ourClient->logo_company) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo_company" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.loglBwDropzone = {
    url: '{{ route('admin.our-clients.storeMedia') }}',
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
      $('form').find('input[name="logl_bw"]').remove()
      $('form').append('<input type="hidden" name="logl_bw" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logl_bw"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($ourClient) && $ourClient->logl_bw)
      var file = {!! json_encode($ourClient->logl_bw) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logl_bw" value="' + file.file_name + '">')
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