<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSerchTagRequest;
use App\Http\Requests\UpdateSerchTagRequest;
use App\Http\Resources\Admin\SerchTagResource;
use App\Models\SerchTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SerchTagApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('serch_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SerchTagResource(SerchTag::all());
    }

    public function store(StoreSerchTagRequest $request)
    {
        $serchTag = SerchTag::create($request->all());

        return (new SerchTagResource($serchTag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SerchTag $serchTag)
    {
        abort_if(Gate::denies('serch_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SerchTagResource($serchTag);
    }

    public function update(UpdateSerchTagRequest $request, SerchTag $serchTag)
    {
        $serchTag->update($request->all());

        return (new SerchTagResource($serchTag))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SerchTag $serchTag)
    {
        abort_if(Gate::denies('serch_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serchTag->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
