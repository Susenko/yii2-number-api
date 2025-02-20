<?php

namespace app\dto;

class SumEvenNumbersDto
{
    private array $numbers;

    public function __construct(array $numbers)
    {
        $this->numbers = array_filter($numbers, fn($num) => is_numeric($num));
    }

    public function getSumEven(): int
    {
        return array_sum(array_filter($this->numbers, fn($num) => $num % 2 === 0));
    }
}
