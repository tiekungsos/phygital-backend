<?php

namespace App\Http\Requests;

use App\Models\WorkCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('work_category_create');
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
