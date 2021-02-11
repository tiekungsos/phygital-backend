<?php

namespace App\Http\Requests;

use App\Models\SerchTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSerchTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('serch_tag_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
