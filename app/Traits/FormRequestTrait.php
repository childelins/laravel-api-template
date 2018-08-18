<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;

trait FormRequestTrait
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        // https://github.com/dingo/api/issues/1473
        if ($this->is(config('api.prefix') . '/*')) {
            throw new \Exception($validator->errors()->first());
        }

        parent::failedValidation($validator);
    }
}
