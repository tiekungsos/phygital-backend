<?php

namespace App\Http\Requests;

use App\Models\Slider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSliderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('slider_edit');
    }

    public function rules()
    {
        return [
            'status'        => [
                'required',
            ],
            'header'        => [
                'string',
                'required',
            ],
            'header_second' => [
                'string',
                'required',
            ],
        ];
    }
}
