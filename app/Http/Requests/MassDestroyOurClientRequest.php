<?php

namespace App\Http\Requests;

use App\Models\OurClient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOurClientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('our_client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:our_clients,id',
        ];
    }
}
