<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGrowupBlogRequest;
use App\Http\Requests\StoreGrowupBlogRequest;
use App\Http\Requests\UpdateGrowupBlogRequest;
use App\Models\GrowupBlog;
use App\Models\GrowupCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class GrowupBlogController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('growup_blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $growupBlogs = GrowupBlog::with(['types', 'media'])->get();

        return view('admin.growupBlogs.index', compact('growupBlogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('growup_blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = GrowupCategory::all()->pluck('name', 'id');

        return view('admin.growupBlogs.create', compact('types'));
    }

    public function store(StoreGrowupBlogRequest $request)
    {
        $growupBlog = GrowupBlog::create($request->all());
        $growupBlog->types()->sync($request->input('types', []));

        if ($request->input('image', false)) {
            $growupBlog->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $growupBlog->id]);
        }

        return redirect()->route('admin.growup-blogs.index');
    }

    public function edit(GrowupBlog $growupBlog)
    {
        abort_if(Gate::denies('growup_blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = GrowupCategory::all()->pluck('name', 'id');

        $growupBlog->load('types');

        return view('admin.growupBlogs.edit', compact('types', 'growupBlog'));
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

        return redirect()->route('admin.growup-blogs.index');
    }

    public function show(GrowupBlog $growupBlog)
    {
        abort_if(Gate::denies('growup_blog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $growupBlog->load('types');

        return view('admin.growupBlogs.show', compact('growupBlog'));
    }

    public function destroy(GrowupBlog $growupBlog)
    {
        abort_if(Gate::denies('growup_blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $growupBlog->delete();

        return back();
    }

    public function massDestroy(MassDestroyGrowupBlogRequest $request)
    {
        GrowupBlog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('growup_blog_create') && Gate::denies('growup_blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new GrowupBlog();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
