<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;
use App\Traits\FormRequestTrait;

class BaseRequest extends FormRequest
{
    use FormRequestTrait;

    public function authorize()
    {
        return true;
    }
}
