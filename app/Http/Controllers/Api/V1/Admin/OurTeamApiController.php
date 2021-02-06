<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOurTeamRequest;
use App\Http\Requests\UpdateOurTeamRequest;
use App\Http\Resources\Admin\OurTeamResource;
use App\Models\OurTeam;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OurTeamApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('our_team_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OurTeamResource(OurTeam::all());
    }

    public function store(StoreOurTeamRequest $request)
    {
        $ourTeam = OurTeam::create($request->all());

        if ($request->input('image', false)) {
            $ourTeam->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new OurTeamResource($ourTeam))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OurTeam $ourTeam)
    {
        abort_if(Gate::denies('our_team_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OurTeamResource($ourTeam);
    }

    public function update(UpdateOurTeamRequest $request, OurTeam $ourTeam)
    {
        $ourTeam->update($request->all());

        if ($request->input('image', false)) {
            if (!$ourTeam->image || $request->input('image') !== $ourTeam->image->file_name) {
                if ($ourTeam->image) {
                    $ourTeam->image->delete();
                }

                $ourTeam->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($ourTeam->image) {
            $ourTeam->image->delete();
        }

        return (new OurTeamResource($ourTeam))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OurTeam $ourTeam)
    {
        abort_if(Gate::denies('our_team_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ourTeam->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
