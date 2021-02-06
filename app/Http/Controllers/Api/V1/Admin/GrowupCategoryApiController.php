<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrowupCategoryRequest;
use App\Http\Requests\UpdateGrowupCategoryRequest;
use App\Http\Resources\Admin\GrowupCategoryResource;
use App\Models\GrowupCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GrowupCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('growup_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GrowupCategoryResource(GrowupCategory::all());
    }

    public function store(StoreGrowupCategoryRequest $request)
    {
        $growupCategory = GrowupCategory::create($request->all());

        return (new GrowupCategoryResource($growupCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GrowupCategory $growupCategory)
    {
        abort_if(Gate::denies('growup_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GrowupCategoryResource($growupCategory);
    }

    public function update(UpdateGrowupCategoryRequest $request, GrowupCategory $growupCategory)
    {
        $growupCategory->update($request->all());

        return (new GrowupCategoryResource($growupCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GrowupCategory $growupCategory)
    {
        abort_if(Gate::denies('growup_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $growupCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
