<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWorkRequest;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\OurClient;
use App\Models\SerchTag;
use App\Models\Work;
use App\Models\WorkCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class WorkController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $works = Work::with(['type_of_works', 'serch_tags', 'clients', 'media'])->get();

        return view('admin.works.index', compact('works'));
    }

    public function create()
    {
        abort_if(Gate::denies('work_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type_of_works = WorkCategory::all()->pluck('type_name', 'id');

        $serch_tags = SerchTag::all()->pluck('name', 'id');

        $clients = OurClient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.works.create', compact('type_of_works', 'serch_tags', 'clients'));
    }

    public function store(StoreWorkRequest $request)
    {
        $work = Work::create($request->all());
        $work->type_of_works()->sync($request->input('type_of_works', []));
        $work->serch_tags()->sync($request->input('serch_tags', []));

        if ($request->input('header_image', false)) {
            $work->addMedia(storage_path('tmp/uploads/' . $request->input('header_image')))->toMediaCollection('header_image');
        }

        foreach ($request->input('all_work_image', []) as $file) {
            $work->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('all_work_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $work->id]);
        }

        return redirect()->route('admin.works.index');
    }

    public function edit(Work $work)
    {
        abort_if(Gate::denies('work_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type_of_works = WorkCategory::all()->pluck('type_name', 'id');

        $serch_tags = SerchTag::all()->pluck('name', 'id');

        $clients = OurClient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $work->load('type_of_works', 'serch_tags', 'clients');

        return view('admin.works.edit', compact('type_of_works', 'serch_tags', 'clients', 'work'));
    }

    public function update(UpdateWorkRequest $request, Work $work)
    {
        $work->update($request->all());
        $work->type_of_works()->sync($request->input('type_of_works', []));
        $work->serch_tags()->sync($request->input('serch_tags', []));

        if ($request->input('header_image', false)) {
            if (!$work->header_image || $request->input('header_image') !== $work->header_image->file_name) {
                if ($work->header_image) {
                    $work->header_image->delete();
                }

                $work->addMedia(storage_path('tmp/uploads/' . $request->input('header_image')))->toMediaCollection('header_image');
            }
        } elseif ($work->header_image) {
            $work->header_image->delete();
        }

        if (count($work->all_work_image) > 0) {
            foreach ($work->all_work_image as $media) {
                if (!in_array($media->file_name, $request->input('all_work_image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $work->all_work_image->pluck('file_name')->toArray();

        foreach ($request->input('all_work_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $work->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('all_work_image');
            }
        }

        return redirect()->route('admin.works.index');
    }

    public function show(Work $work)
    {
        abort_if(Gate::denies('work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work->load('type_of_works', 'serch_tags', 'clients');

        return view('admin.works.show', compact('work'));
    }

    public function destroy(Work $work)
    {
        abort_if(Gate::denies('work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkRequest $request)
    {
        Work::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('work_create') && Gate::denies('work_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Work();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
