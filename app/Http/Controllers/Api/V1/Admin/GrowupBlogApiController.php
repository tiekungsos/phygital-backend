<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGrowupBlogRequest;
use App\Http\Requests\UpdateGrowupBlogRequest;
use App\Http\Resources\Admin\GrowupBlogResource;
use App\Models\GrowupBlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GrowupBlogApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('growup_blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GrowupBlogResource(GrowupBlog::with(['types'])->get());
    }


    public function getData()
    {
        return new GrowupBlogResource(GrowupBlog::with(['types'])->get());
    }

    public function store(StoreGrowupBlogRequest $request)
    {
        $growupBlog = GrowupBlog::create($request->all());
        $growupBlog->types()->sync($request->input('types', []));

        if ($request->input('image', false)) {
            $growupBlog->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new GrowupBlogResource($growupBlog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GrowupBlog $growupBlog)
    {
        abort_if(Gate::denies('growup_blog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GrowupBlogResource($growupBlog->load(['types']));
    }

    public function update(UpdateGrowupBlogRequest $request, GrowupBlog $growupBlog)
    {
        $growupBlog->update($request->all());
        $growupBlog->types()->sync($request->input('types', []));

        if ($request->input('image', false)) {
            if (!$growupBlog->image || $request->input('image') !== $growupBlog->image->file_name) {
                if ($growupBlog->image) {
                    $growupBlog->image->delete();
                }

                $growupBlog->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($growupBlog->image) {
            $growupBlog->image->delete();
        }

        return (new GrowupBlogResource($growupBlog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GrowupBlog $growupBlog)
    {
        abort_if(Gate::denies('growup_blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $growupBlog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
