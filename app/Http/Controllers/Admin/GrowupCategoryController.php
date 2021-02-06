<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGrowupCategoryRequest;
use App\Http\Requests\StoreGrowupCategoryRequest;
use App\Http\Requests\UpdateGrowupCategoryRequest;
use App\Models\GrowupCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GrowupCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('growup_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $growupCategories = GrowupCategory::all();

        return view('admin.growupCategories.index', compact('growupCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('growup_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.growupCategories.create');
    }

    public function store(StoreGrowupCategoryRequest $request)
    {
        $growupCategory = GrowupCategory::create($request->all());

        return redirect()->route('admin.growup-categories.index');
    }

    public function edit(GrowupCategory $growupCategory)
    {
        abort_if(Gate::denies('growup_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.growupCategories.edit', compact('growupCategory'));
    }

    public function update(UpdateGrowupCategoryRequest $request, GrowupCategory $growupCategory)
    {
        $growupCategory->update($request->all());

        return redirect()->route('admin.growup-categories.index');
    }

    public function show(GrowupCategory $growupCategory)
    {
        abort_if(Gate::denies('growup_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.growupCategories.show', compact('growupCategory'));
    }

    public function destroy(GrowupCategory $growupCategory)
    {
        abort_if(Gate::denies('growup_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $growupCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyGrowupCategoryRequest $request)
    {
        GrowupCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
