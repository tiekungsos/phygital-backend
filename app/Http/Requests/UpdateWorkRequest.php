<?php

namespace App\Http\Requests;

use App\Models\Work;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('work_edit');
    }

    public function rules()
    {
        return [
            'name_work'       => [
                'string',
                'required',
            ],
            'type_of_works.*' => [
                'integer',
            ],
            'type_of_works'   => [
                'array',
            ],
            'work_detail'     => [
                'required',
            ],
        ];
    }
}
