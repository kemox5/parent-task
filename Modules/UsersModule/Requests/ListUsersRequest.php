<?php

namespace Modules\UsersModule\Requests;

use App\Http\Requests\ApiBaseRequest;

class ListUsersRequest extends ApiBaseRequest
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'provider' => ['nullable', 'string', 'in:DataProviderX,DataProviderY'],
            'statusCode' => ['nullable', 'string', 'in:authorised,decline,refunded'],
            'balanceMin' => ['nullable', 'numeric', 'required_with:balanceMax', 'min:0'],
            'balanceMax' => ['nullable', 'numeric', 'required_with:balanceMin', 'gt:balanceMin'],
            'currency' => ['nullable', 'string', 'size:3'],
            'page' => ['nullable', 'numeric', 'min:1'],
            'per_page' => ['nullable', 'numeric', 'min:1', 'max:200'],
        ];
    }
}
