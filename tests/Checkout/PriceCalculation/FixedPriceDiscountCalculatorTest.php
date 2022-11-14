<?php

namespace App\Tests\Checkout\PriceCalculation;

use App\Checkout\Discount\FixedPriceDiscount;
use App\Checkout\PriceCalculation\DiscountCalculatorInterface;
use App\Checkout\PriceCalculation\FixedPriceDiscountCalculator;
use PHPUnit\Framework\TestCase;

class FixedPriceDiscountCalculatorTest extends TestCase
{
	/** @test */
	public function it_should_implement_the_discount_calculator_interface()
	{
		$fixedPriceDiscountCalculator = new FixedPriceDiscountCalculator(null);

		$this->assertInstanceOf(DiscountCalculatorInterface::class, $fixedPriceDiscountCalculator);
	}

	/** @test */
	public function calculation_should_return_zero()
	{
		$discountCalculator = new FixedPriceDiscountCalculator(null);

		$this->assertEquals(
			0,
			$discountCalculator->calculate('A', 1, 50)
		);

		$discount = new FixedPriceDiscount(1, 50);
		$discountCalculator = new FixedPriceDiscountCalculator($discount);

		$this->assertEquals(
			0,
			$discountCalculator->calculate('A', 1, 50)
		);
	}

	/** @test */
	public function calculation_should_return_ten()
	{
		$discount = new FixedPriceDiscount(2, 90);
		$discountCalculator = new FixedPriceDiscountCalculator($discount);

		$this->assertEquals(
			10,
			$discountCalculator->calculate('A', 2, 50)
		);
	}

	/** @test */
	public function calculation_should_return_forty()
	{
		$discount = new FixedPriceDiscount(5, 210);
		$discountCalculator = new FixedPriceDiscountCalculator($discount);

		$this->assertEquals(
			40,
			$discountCalculator->calculate('A', 5, 50)
		);
	}
}
