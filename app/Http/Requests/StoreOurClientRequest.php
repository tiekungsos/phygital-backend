<?php

namespace App\Http\Requests;

use App\Models\OurClient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOurClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('our_client_create');
    }

    public function rules()
    {
        return [
            'name'         => [
                'string',
                'nullable',
            ],
            'logo_company' => [
                'required',
            ],
            'logl_bw'      => [
                'required',
            ],
        ];
    }
}
