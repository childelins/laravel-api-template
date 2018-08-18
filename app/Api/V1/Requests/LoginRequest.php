<?php

namespace App\Api\V1\Requests;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        // https://github.com/mewebstudio/captcha/issues/115
        return [
            'name' => 'required',
            'password' => 'required',
            'ckey' => 'required',
            'captcha' => 'required|captcha_api:' . request('ckey'),
        ];
    }

    public function messages()
    {
        return [
            'captcha.captcha_api' => '验证码错误',
        ];
    }
}
