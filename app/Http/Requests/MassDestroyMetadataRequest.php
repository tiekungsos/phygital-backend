<?php

namespace App\Http\Requests;

use App\Models\Metadata;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMetadataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('metadata_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:metadata,id',
        ];
    }
}
