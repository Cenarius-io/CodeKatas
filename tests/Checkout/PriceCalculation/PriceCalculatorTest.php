<?php

namespace App\Tests\Checkout\PriceCalculation;

use App\Checkout\PriceCalculation\DiscountCalculatorFactory;
use App\Checkout\PriceCalculation\PriceCalculator;
use App\Checkout\PriceCalculation\PriceCalculatorInterface;
use App\Tests\Checkout\PriceTablesTrait;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
	use PriceTablesTrait;

	/** @test */
	public function it_should_implement_the_price_calculator_interface()
	{
		$priceCalculator = new PriceCalculator(new DiscountCalculatorFactory());

		$this->assertInstanceOf(PriceCalculatorInterface::class, $priceCalculator);
	}

	/**
	 * @test
	 * @dataProvider getBaseCarts
	 */
	public function price_calculation_without_discount(array $cart, int $expected)
	{
		$priceCalculator = new PriceCalculator(new DiscountCalculatorFactory());

		$this->assertEquals(
			$expected,
			$priceCalculator->calculateTotal($cart, $this->getPriceTableB())
		);
	}

	/**
	 * @test
	 * @dataProvider getDiscounts
	 */
	public function price_calculation_with_discount(array $cart, int $expected)
	{
		$priceCalculator = new PriceCalculator(new DiscountCalculatorFactory());

		$this->assertEquals(
			$expected,
			$priceCalculator->getDiscountTotal($cart, $this->getPriceTableA())
		);
	}


	public function getBaseCarts(): array
	{
		return [
			[
				[],
				0,
			],
			[
				[
					'A',
				],
				50,
			],
			[
				[
					'A',
					'A',
					'B',
				],
				130,
			],
			[
				[
					'A',
					'A',
					'B',
				],
				130,
			],
		];
	}

	public function getDiscounts(): array
	{
		return [
			[
				[],
				0,
			],
			[
				[
					'A',
				],
				0,
			],
			[
				[
					'A',
					'A',
					'A',
				],
				20,
			],
			[
				[
					'A',
					'A',
					'A',
					'B',
					'C',
				],
				20,
			],
			[
				[
					'A',
					'A',
					'A',
					'B',
					'B',
				],
				35,
			],
			[
				[
					'A',
					'A',
					'A',
					'A',
					'A',
					'A',
					'B',
					'B',
				],
				55,
			],
			[
				[
					'A',
					'A',
					'A',
					'A',
					'A',
					'A',
					'B',
					'B',
					'C',
					'C',
					'D',
				],
				55,
			],
		];
	}
}
