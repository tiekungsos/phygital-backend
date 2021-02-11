<?php

namespace App\Http\Requests;

use App\Models\SerchTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySerchTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('serch_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:serch_tags,id',
        ];
    }
}
