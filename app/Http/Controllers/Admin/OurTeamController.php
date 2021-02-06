<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOurTeamRequest;
use App\Http\Requests\StoreOurTeamRequest;
use App\Http\Requests\UpdateOurTeamRequest;
use App\Models\OurTeam;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OurTeamController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('our_team_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ourTeams = OurTeam::with(['media'])->get();

        return view('admin.ourTeams.index', compact('ourTeams'));
    }

    public function create()
    {
        abort_if(Gate::denies('our_team_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ourTeams.create');
    }

    public function store(StoreOurTeamRequest $request)
    {
        $ourTeam = OurTeam::create($request->all());

        if ($request->input('image', false)) {
            $ourTeam->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ourTeam->id]);
        }

        return redirect()->route('admin.our-teams.index');
    }

    public function edit(OurTeam $ourTeam)
    {
        abort_if(Gate::denies('our_team_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ourTeams.edit', compact('ourTeam'));
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

        return redirect()->route('admin.our-teams.index');
    }

    public function show(OurTeam $ourTeam)
    {
        abort_if(Gate::denies('our_team_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ourTeams.show', compact('ourTeam'));
    }

    public function destroy(OurTeam $ourTeam)
    {
        abort_if(Gate::denies('our_team_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ourTeam->delete();

        return back();
    }

    public function massDestroy(MassDestroyOurTeamRequest $request)
    {
        OurTeam::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('our_team_create') && Gate::denies('our_team_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new OurTeam();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
