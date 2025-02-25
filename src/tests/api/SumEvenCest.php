<?php

declare(strict_types=1);

namespace Api;

use ApiTester;

final class SumEvenCest
{
    private string $endpoint = '/sum-even';

    public function testValidEvenSum(ApiTester $I): void
    {
        $I->sendPost($this->endpoint, ['numbers' => [1, 2, 3, 4, 5, 6]]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['sum' => 12]);
    }

    public function testInvalidData(ApiTester $I): void
    {
        $I->sendPost($this->endpoint, ['numbers' => [1, 'a', 3, 4]]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'Incorrect format. Numbers required.']);
    }

    public function testMissingNumbersKey(ApiTester $I): void
    {
        $I->sendPost($this->endpoint, []);
        $I->seeResponseCodeIs(500);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'Missing "numbers" key in request.']);
    }

    public function testNegativeNumbers(ApiTester $I): void
    {
        $I->sendPost($this->endpoint, ['numbers' => [-1, -2, -3, -4]]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['sum' => -6]); // -2 + -4 = -6
    }

    public function testOnlyOddNumbers(ApiTester $I): void
    {
        $I->sendPost($this->endpoint, ['numbers' => [1, 3, 5, 7, 9]]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['sum' => 0]); // No even numbers
    }

    public function testLargeNumbers(ApiTester $I): void
    {
        $I->sendPost($this->endpoint, ['numbers' => [1000000, 2000000, 3000000]]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['sum' => 6000000]);
    }

    public function testSpecialCharacters(ApiTester $I): void
    {
        $I->sendPost($this->endpoint, ['numbers' => [1, 2, '@', 4, '%']]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'Incorrect format. Numbers required.']);
    }

    public function testBooleanValues(ApiTester $I): void
    {
        $I->sendPost($this->endpoint, ['numbers' => [true, false, 2, 4]]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'Incorrect format. Numbers required.']);
    }
}
