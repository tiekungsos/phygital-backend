@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ourClient.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.our-clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ourClient.fields.id') }}
                        </th>
                        <td>
                            {{ $ourClient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ourClient.fields.name') }}
                        </th>
                        <td>
                            {{ $ourClient->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ourClient.fields.logo_company') }}
                        </th>
                        <td>
                            @if($ourClient->logo_company)
                                <a href="{{ $ourClient->logo_company->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $ourClient->logo_company->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ourClient.fields.logl_bw') }}
                        </th>
                        <td>
                            @if($ourClient->logl_bw)
                                <a href="{{ $ourClient->logl_bw->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $ourClient->logl_bw->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.our-clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#clients_works" role="tab" data-toggle="tab">
                {{ trans('cruds.work.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="clients_works">
            @includeIf('admin.ourClients.relationships.clientsWorks', ['works' => $ourClient->clientsWorks])
        </div>
    </div>
</div>

@endsection