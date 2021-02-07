<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOurClientRequest;
use App\Http\Requests\UpdateOurClientRequest;
use App\Http\Resources\Admin\OurClientResource;
use App\Models\OurClient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OurClientsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('our_client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OurClientResource(OurClient::all());
    }

    public function getData()
    {
        return new OurClientResource(OurClient::all());
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

        return (new OurClientResource($ourClient))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OurClient $ourClient)
    {
        abort_if(Gate::denies('our_client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OurClientResource($ourClient);
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

        return (new OurClientResource($ourClient))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OurClient $ourClient)
    {
        abort_if(Gate::denies('our_client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ourClient->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
