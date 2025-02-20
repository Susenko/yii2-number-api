<?php

namespace app\validators;

use yii\base\Model;

class NumbersValidator extends Model
{
    public array $numbers = [];

    public function rules(): array
    {
        return [
            ['numbers', 'required'],
            ['numbers', 'each', 'rule' => ['integer']],
        ];
    }
}
