<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOurClientRequest;
use App\Http\Requests\StoreOurClientRequest;
use App\Http\Requests\UpdateOurClientRequest;
use App\Models\OurClient;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OurClientsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('our_client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ourClients = OurClient::with(['media'])->get();

        return view('admin.ourClients.index', compact('ourClients'));
    }

    public function create()
    {
        abort_if(Gate::denies('our_client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ourClients.create');
    }

    public function store(StoreOurClientRequest $request)
    {
        $ourClient = OurClient::create($request->all());

        if ($request->input('logo_company', false)) {
            $ourClient->addMedia(storage_path('tmp/uploads/' . $request->input('logo_company')))->toMediaCollection('logo_company');
        }

        if ($request->input('logl_bw', false)) {
            $ourClient->addMedia(storage_path('tmp/uploads/' . $request->input('logl_bw')))->toMediaCollection('logl_bw');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ourClient->id]);
        }

        return redirect()->route('admin.our-clients.index');
    }

    public function edit(OurClient $ourClient)
    {
        abort_if(Gate::denies('our_client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ourClients.edit', compact('ourClient'));
    }

    public function update(UpdateOurClientRequest $request, OurClient $ourClient)
    {
        $ourClient->update($request->all());

        if ($request->input('logo_company', false)) {
            if (!$ourClient->logo_company || $request->input('logo_company') !== $ourClient->logo_company->file_name) {
                if ($ourClient->logo_company) {
                    $ourClient->logo_company->delete();
                }

                $ourClient->addMedia(storage_path('tmp/uploads/' . $request->input('logo_company')))->toMediaCollection('logo_company');
            }
        } elseif ($ourClient->logo_company) {
            $ourClient->logo_company->delete();
        }

        if ($request->input('logl_bw', false)) {
            if (!$ourClient->logl_bw || $request->input('logl_bw') !== $ourClient->logl_bw->file_name) {
                if ($ourClient->logl_bw) {
                    $ourClient->logl_bw->delete();
                }

                $ourClient->addMedia(storage_path('tmp/uploads/' . $request->input('logl_bw')))->toMediaCollection('logl_bw');
            }
        } elseif ($ourClient->logl_bw) {
            $ourClient->logl_bw->delete();
        }

        return redirect()->route('admin.our-clients.index');
    }

    public function show(OurClient $ourClient)
    {
        abort_if(Gate::denies('our_client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ourClient->load('clientsWorks');

        return view('admin.ourClients.show', compact('ourClient'));
    }

    public function destroy(OurClient $ourClient)
    {
        abort_if(Gate::denies('our_client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ourClient->delete();

        return back();
    }

    public function massDestroy(MassDestroyOurClientRequest $request)
    {
        OurClient::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('our_client_create') && Gate::denies('our_client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new OurClient();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
