<?php

namespace App\Http\Requests;

use App\Models\GrowupBlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGrowupBlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('growup_blog_edit');
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
            'types.*'    => [
                'integer',
            ],
            'types'      => [
                'array',
            ],
        ];
    }
}
