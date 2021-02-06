<?php

namespace App\Http\Requests;

use App\Models\GrowupBlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGrowupBlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('growup_blog_create');
    }

    public function rules()
    {
        return [
            'blog_name'  => [
                'string',
                'required',
            ],
            'name_write' => [
                'string',
                'nullable',
            ],
            'image'      => [
                'required',
            ],
            'types.*'    => [
                'integer',
            ],
            'types'      => [
                'array',
            ],
        ];
    }
}
