@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.work.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.works.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name_work">{{ trans('cruds.work.fields.name_work') }}</label>
                <input class="form-control {{ $errors->has('name_work') ? 'is-invalid' : '' }}" type="text" name="name_work" id="name_work" value="{{ old('name_work', '') }}" required>
                @if($errors->has('name_work'))
                    <span class="text-danger">{{ $errors->first('name_work') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.work.fields.name_work_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type_of_works">{{ trans('cruds.work.fields.type_of_work') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('type_of_works') ? 'is-invalid' : '' }}" name="type_of_works[]" id="type_of_works" multiple>
                    @foreach($type_of_works as $id => $type_of_work)
                        <option value="{{ $id }}" {{ in_array($id, old('type_of_works', [])) ? 'selected' : '' }}>{{ $type_of_work }}</option>
                    @endforeach
                </select>
                @if($errors->has('type_of_works'))
                    <span class="text-danger">{{ $errors->first('type_of_works') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.work.fields.type_of_work_helper') }}</span>
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
                <label for="clients_id">{{ trans('cruds.work.fields.clients') }}</label>
                <select class="form-control select2 {{ $errors->has('clients') ? 'is-invalid' : '' }}" name="clients_id" id="clients_id">
                    @foreach($clients as $id => $clients)
                        <option value="{{ $id }}" {{ old('clients_id') == $id ? 'selected' : '' }}>{{ $clients }}</option>
                    @endforeach
                </select>
                @if($errors->has('clients'))
                    <span class="text-danger">{{ $errors->first('clients') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.work.fields.clients_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="work_detail">{{ trans('cruds.work.fields.work_detail') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('work_detail') ? 'is-invalid' : '' }}" name="work_detail" id="work_detail">{!! old('work_detail') !!}</textarea>
                @if($errors->has('work_detail'))
                    <span class="text-danger">{{ $errors->first('work_detail') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.work.fields.work_detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="header_image">{{ trans('cruds.work.fields.header_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('header_image') ? 'is-invalid' : '' }}" id="header_image-dropzone">
                </div>
                @if($errors->has('header_image'))
                    <span class="text-danger">{{ $errors->first('header_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.work.fields.header_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="all_work_image">{{ trans('cruds.work.fields.all_work_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('all_work_image') ? 'is-invalid' : '' }}" id="all_work_image-dropzone">
                </div>
                @if($errors->has('all_work_image'))
                    <span class="text-danger">{{ $errors->first('all_work_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.work.fields.all_work_image_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/works/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $work->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.headerImageDropzone = {
    url: '{{ route('admin.works.storeMedia') }}',
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
      $('form').find('input[name="header_image"]').remove()
      $('form').append('<input type="hidden" name="header_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="header_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($work) && $work->header_image)
      var file = {!! json_encode($work->header_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="header_image" value="' + file.file_name + '">')
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
    var uploadedAllWorkImageMap = {}
Dropzone.options.allWorkImageDropzone = {
    url: '{{ route('admin.works.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="all_work_image[]" value="' + response.name + '">')
      uploadedAllWorkImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAllWorkImageMap[file.name]
      }
      $('form').find('input[name="all_work_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($work) && $work->all_work_image)
      var files = {!! json_encode($work->all_work_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="all_work_image[]" value="' + file.file_name + '">')
        }
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