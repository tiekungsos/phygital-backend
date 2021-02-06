@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.growupBlog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.growup-blogs.update", [$growupBlog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="blog_name">{{ trans('cruds.growupBlog.fields.blog_name') }}</label>
                <input class="form-control {{ $errors->has('blog_name') ? 'is-invalid' : '' }}" type="text" name="blog_name" id="blog_name" value="{{ old('blog_name', $growupBlog->blog_name) }}" required>
                @if($errors->has('blog_name'))
                    <span class="text-danger">{{ $errors->first('blog_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.growupBlog.fields.blog_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_write">{{ trans('cruds.growupBlog.fields.name_write') }}</label>
                <input class="form-control {{ $errors->has('name_write') ? 'is-invalid' : '' }}" type="text" name="name_write" id="name_write" value="{{ old('name_write', $growupBlog->name_write) }}">
                @if($errors->has('name_write'))
                    <span class="text-danger">{{ $errors->first('name_write') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.growupBlog.fields.name_write_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.growupBlog.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.growupBlog.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="types">{{ trans('cruds.growupBlog.fields.type') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('types') ? 'is-invalid' : '' }}" name="types[]" id="types" multiple>
                    @foreach($types as $id => $type)
                        <option value="{{ $id }}" {{ (in_array($id, old('types', [])) || $growupBlog->types->contains($id)) ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @if($errors->has('types'))
                    <span class="text-danger">{{ $errors->first('types') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.growupBlog.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="detail">{{ trans('cruds.growupBlog.fields.detail') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('detail') ? 'is-invalid' : '' }}" name="detail" id="detail">{!! old('detail', $growupBlog->detail) !!}</textarea>
                @if($errors->has('detail'))
                    <span class="text-danger">{{ $errors->first('detail') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.growupBlog.fields.detail_helper') }}</span>
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.growup-blogs.storeMedia') }}',
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
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($growupBlog) && $growupBlog->image)
      var file = {!! json_encode($growupBlog->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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
                xhr.open('POST', '/admin/growup-blogs/ckmedia', true);
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
                data.append('crud_id', '{{ $growupBlog->id ?? 0 }}');
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

@endsection