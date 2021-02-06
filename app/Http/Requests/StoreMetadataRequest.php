<?php

namespace App\Http\Requests;

use App\Models\Metadata;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMetadataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('metadata_create');
    }

    public function rules()
    {
        return [
            'setting' => [
                'string',
                'nullable',
            ],
        ];
    }
}
