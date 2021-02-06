<?php

namespace App\Http\Requests;

use App\Models\GrowupCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGrowupCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('growup_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:growup_categories,id',
        ];
    }
}
