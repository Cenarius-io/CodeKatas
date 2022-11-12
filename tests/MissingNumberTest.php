<?php

use App\MissingNumber;
use PHPUnit\Framework\TestCase;

class MissingNumberTest extends TestCase
{
	/**
	 * @test
	 * @dataProvider numbers
	 */
	public function first_missing_number($expected, $numbers)
	{
		$missingNumber = MissingNumber::getFirstMissingNumber($numbers);

		$this->assertEquals($expected, $missingNumber);
	}

	public function numbers(): array
	{
		return [
			[1, [-1, -3]],
			[2, [-1, -3, 1]],
			[4, [1, 2, 3]],
			[5, [1, 3, 6, 4, 1, 2]]
		];
	}
}
