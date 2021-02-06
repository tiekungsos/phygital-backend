<?php

namespace App\Http\Requests;

use App\Models\GrowupCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGrowupCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('growup_category_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
