<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkCategoryRequest;
use App\Http\Requests\StoreWorkCategoryRequest;
use App\Http\Requests\UpdateWorkCategoryRequest;
use App\Models\WorkCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('work_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workCategories = WorkCategory::all();

        return view('admin.workCategories.index', compact('workCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('work_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workCategories.create');
    }

    public function store(StoreWorkCategoryRequest $request)
    {
        $workCategory = WorkCategory::create($request->all());

        return redirect()->route('admin.work-categories.index');
    }

    public function edit(WorkCategory $workCategory)
    {
        abort_if(Gate::denies('work_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workCategories.edit', compact('workCategory'));
    }

    public function update(UpdateWorkCategoryRequest $request, WorkCategory $workCategory)
    {
        $workCategory->update($request->all());

        return redirect()->route('admin.work-categories.index');
    }

    public function show(WorkCategory $workCategory)
    {
        abort_if(Gate::denies('work_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workCategory->load('typeOfWorkWorks');

        return view('admin.workCategories.show', compact('workCategory'));
    }

    public function destroy(WorkCategory $workCategory)
    {
        abort_if(Gate::denies('work_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkCategoryRequest $request)
    {
        WorkCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
