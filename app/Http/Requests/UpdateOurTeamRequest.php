<?php

namespace App\Http\Requests;

use App\Models\OurTeam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOurTeamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('our_team_edit');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'position'      => [
                'string',
                'max:-1',
                'nullable',
            ],
            'detail_person' => [
                'required',
            ],
        ];
    }
}
