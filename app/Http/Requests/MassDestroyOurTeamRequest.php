<?php

namespace App\Http\Requests;

use App\Models\OurTeam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOurTeamRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('our_team_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:our_teams,id',
        ];
    }
}
