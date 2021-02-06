<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\UpdateMetadataRequest;
use App\Models\Metadata;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MetadataController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('metadata_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $metadata = Metadata::with(['media'])->get();

        return view('admin.metadata.index', compact('metadata'));
    }

    public function edit(Metadata $metadata)
    {
        abort_if(Gate::denies('metadata_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.metadata.edit', compact('metadata'));
    }

    public function update(UpdateMetadataRequest $request, Metadata $metadata)
    {
        $metadata->update($request->all());

        if ($request->input('detail_image', false)) {
            if (!$metadata->detail_image || $request->input('detail_image') !== $metadata->detail_image->file_name) {
                if ($metadata->detail_image) {
                    $metadata->detail_image->delete();
                }

                $metadata->addMedia(storage_path('tmp/uploads/' . $request->input('detail_image')))->toMediaCollection('detail_image');
            }
        } elseif ($metadata->detail_image) {
            $metadata->detail_image->delete();
        }

        return redirect()->route('admin.metadata.index');
    }

    public function show(Metadata $metadata)
    {
        abort_if(Gate::denies('metadata_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.metadata.show', compact('metadata'));
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('metadata_create') && Gate::denies('metadata_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Metadata();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
