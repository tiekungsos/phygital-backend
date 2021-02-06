<?php

namespace App\Http\Requests;

use App\Models\Metadata;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMetadataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('metadata_edit');
    }

    public function rules()
    {
        return [];
    }
}
