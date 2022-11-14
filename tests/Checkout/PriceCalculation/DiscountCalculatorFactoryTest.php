<?php

namespace App\Tests\Checkout\PriceCalculation;

use App\Checkout\Discount\DiscountInterface;
use App\Checkout\Discount\FixedPriceDiscount;
use App\Checkout\PriceCalculation\DiscountCalculatorFactory;
use App\Checkout\PriceCalculation\FixedPriceDiscountCalculator;
use App\Checkout\PriceCalculation\UnknownDiscountCalculator;
use PHPUnit\Framework\TestCase;

class DiscountCalculatorFactoryTest extends TestCase
{
	/** @test */
	public function it_should_return_a_fixed_price_discount_calculator_object()
	{
		$discount = new FixedPriceDiscount(3, 130);

		$discountCalculatorFactory = new DiscountCalculatorFactory();

		$calculator = $discountCalculatorFactory->getDiscountCalculator($discount);

		$this->assertInstanceOf(FixedPriceDiscountCalculator::class, $calculator);
	}

	/** @test */
	public function it_should_return_null()
	{
		$discountCalculatorFactory = new DiscountCalculatorFactory();

		$calculator = $discountCalculatorFactory->getDiscountCalculator(null);
		$this->assertEquals(null, $calculator);
	}

	/** @test */
	public function it_should_throw_an_unknown_discount_calculator_exception()
	{
		$this->expectException(UnknownDiscountCalculator::class);

		$discountCalculatorFactory = new DiscountCalculatorFactory();

		$mock = $this->createMock(DiscountInterface::class);

		$calculator = $discountCalculatorFactory->getDiscountCalculator($mock);

		$this->assertEquals(null, $calculator);
	}
}
