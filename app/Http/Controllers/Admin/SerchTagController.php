<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySerchTagRequest;
use App\Http\Requests\StoreSerchTagRequest;
use App\Http\Requests\UpdateSerchTagRequest;
use App\Models\SerchTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SerchTagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('serch_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serchTags = SerchTag::all();

        return view('admin.serchTags.index', compact('serchTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('serch_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serchTags.create');
    }

    public function store(StoreSerchTagRequest $request)
    {
        $serchTag = SerchTag::create($request->all());

        return redirect()->route('admin.serch-tags.index');
    }

    public function edit(SerchTag $serchTag)
    {
        abort_if(Gate::denies('serch_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serchTags.edit', compact('serchTag'));
    }

    public function update(UpdateSerchTagRequest $request, SerchTag $serchTag)
    {
        $serchTag->update($request->all());

        return redirect()->route('admin.serch-tags.index');
    }

    public function show(SerchTag $serchTag)
    {
        abort_if(Gate::denies('serch_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serchTag->load('serchTagWorks');

        return view('admin.serchTags.show', compact('serchTag'));
    }

    public function destroy(SerchTag $serchTag)
    {
        abort_if(Gate::denies('serch_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serchTag->delete();

        return back();
    }

    public function massDestroy(MassDestroySerchTagRequest $request)
    {
        SerchTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
