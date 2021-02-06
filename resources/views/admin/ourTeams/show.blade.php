@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ourTeam.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.our-teams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ourTeam.fields.id') }}
                        </th>
                        <td>
                            {{ $ourTeam->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ourTeam.fields.name') }}
                        </th>
                        <td>
                            {{ $ourTeam->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ourTeam.fields.position') }}
                        </th>
                        <td>
                            {{ $ourTeam->position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ourTeam.fields.detail_person') }}
                        </th>
                        <td>
                            {!! $ourTeam->detail_person !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ourTeam.fields.image') }}
                        </th>
                        <td>
                            @if($ourTeam->image)
                                <a href="{{ $ourTeam->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $ourTeam->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.our-teams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection