<?php

namespace App\Http\Requests;

use App\Models\Work;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('work_create');
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
            'serch_tags.*'    => [
                'integer',
            ],
            'serch_tags'      => [
                'required',
                'array',
            ],
            'work_detail'     => [
                'required',
            ],
        ];
    }
}
