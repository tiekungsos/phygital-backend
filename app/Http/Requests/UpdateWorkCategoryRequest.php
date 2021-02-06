<?php

namespace App\Http\Requests;

use App\Models\WorkCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorkCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('work_category_edit');
    }

    public function rules()
    {
        return [
            'type_name' => [
                'string',
                'required',
            ],
        ];
    }
}
