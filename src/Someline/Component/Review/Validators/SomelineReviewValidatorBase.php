<?php

namespace Someline\Component\Review\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class SomelineReviewValidatorBase extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'reviewable_type' => 'required',
            'reviewable_id' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
        ],
    ];
}
