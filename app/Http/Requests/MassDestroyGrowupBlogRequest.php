<?php

namespace App\Http\Requests;

use App\Models\GrowupBlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGrowupBlogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('growup_blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:growup_blogs,id',
        ];
    }
}
