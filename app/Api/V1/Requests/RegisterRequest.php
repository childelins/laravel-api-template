<?php

namespace App\Api\V1\Requests;

class RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required',
        ];
    }
}
