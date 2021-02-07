<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkCategoryRequest;
use App\Http\Requests\UpdateWorkCategoryRequest;
use App\Http\Resources\Admin\WorkCategoryResource;
use App\Models\WorkCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('work_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkCategoryResource(WorkCategory::all());
    }

    public function getData()
    {
        return new WorkCategoryResource(WorkCategory::with(['typeOfWorkWorks'])->get());

        // return new WorkCategoryResource(WorkCategory::all());
    }

    public function store(StoreWorkCategoryRequest $request)
    {
        $workCategory = WorkCategory::create($request->all());

        return (new WorkCategoryResource($workCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WorkCategory $workCategory)
    {
        abort_if(Gate::denies('work_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkCategoryResource($workCategory);
    }

    public function update(UpdateWorkCategoryRequest $request, WorkCategory $workCategory)
    {
        $workCategory->update($request->all());

        return (new WorkCategoryResource($workCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WorkCategory $workCategory)
    {
        abort_if(Gate::denies('work_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
