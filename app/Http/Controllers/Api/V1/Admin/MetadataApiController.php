<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\UpdateMetadataRequest;
use App\Http\Resources\Admin\MetadataResource;
use App\Models\Metadata;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MetadataApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('metadata_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MetadataResource(Metadata::all());
    }

    public function getData()
    {
        return new MetadataResource(Metadata::all());
    }

    public function show(Metadata $metadata)
    {
        abort_if(Gate::denies('metadata_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MetadataResource($metadata);
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

        return (new MetadataResource($metadata))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
