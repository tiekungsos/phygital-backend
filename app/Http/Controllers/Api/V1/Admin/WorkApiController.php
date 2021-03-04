<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Http\Resources\Admin\WorkResource;
use App\Models\Work;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkResource(Work::with(['type_of_works', 'serch_tags', 'clients'])->get());
    }
    



    public function getData()
    {
        // return new SliderResource(Slider::get();
        $work = Work::with(['type_of_works','serch_tags', 'clients'])
        ->get(array('clients_id','id','name_work','work_detail'))
        ->each->setAppends(['header_image']);

        // $work->clients->setAppends([]);
   

        // dd($work);

        return new WorkResource($work);
    }
    

    public function store(StoreWorkRequest $request)
    {
        $work = Work::create($request->all());
        $work->type_of_works()->sync($request->input('type_of_works', []));
        $work->serch_tags()->sync($request->input('serch_tags', []));

        if ($request->input('header_image', false)) {
            $work->addMedia(storage_path('tmp/uploads/' . $request->input('header_image')))->toMediaCollection('header_image');
        }

        if ($request->input('all_work_image', false)) {
            $work->addMedia(storage_path('tmp/uploads/' . $request->input('all_work_image')))->toMediaCollection('all_work_image');
        }

        return (new WorkResource($work))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Work $work)
    {
        abort_if(Gate::denies('work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkResource($work->load(['type_of_works', 'serch_tags', 'clients']));
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

        if ($request->input('all_work_image', false)) {
            if (!$work->all_work_image || $request->input('all_work_image') !== $work->all_work_image->file_name) {
                if ($work->all_work_image) {
                    $work->all_work_image->delete();
                }

                $work->addMedia(storage_path('tmp/uploads/' . $request->input('all_work_image')))->toMediaCollection('all_work_image');
            }
        } elseif ($work->all_work_image) {
            $work->all_work_image->delete();
        }

        return (new WorkResource($work))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Work $work)
    {
        abort_if(Gate::denies('work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
