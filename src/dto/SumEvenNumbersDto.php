<?php

namespace app\dto;

use yii\base\InvalidArgumentException;

class SumEvenNumbersDto
{
    private array $numbers;

    public function __construct(array $request)
    {
        if (!isset($request['numbers'])) {
            throw new InvalidArgumentException('Missing "numbers" key in request.');
        }

        if (!is_array($request['numbers'])) {
            throw new InvalidArgumentException('"numbers" must be an array of numbers.');
        }

        $this->numbers = $request['numbers'];
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }
}
