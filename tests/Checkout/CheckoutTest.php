<?php

namespace App\Tests\Checkout;

use App\Checkout\Checkout;
use App\Checkout\PriceCalculation\DiscountCalculatorFactory;
use App\Checkout\PriceCalculation\PriceCalculator;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
	use PriceTablesTrait;

	/**
	 * @test
	 * @dataProvider inputItems
	 */
	public function it_should_return_a_formatted_items_array(string $inputItems, array $expected)
	{
		$checkout = new Checkout($this->getPriceTableA(), $this->getPriceCalculator());

		$this->assertEquals($expected, $checkout->formatItems($inputItems));
	}

	/**
	 * @test
	 * @dataProvider sameSkuItems
	 */
	public function get_total_with_same_sku_items(string $itemList, int $expected)
	{
		$checkout = new Checkout($this->getPriceTableA(), $this->getPriceCalculator());

		$checkout->scan($itemList);

		$this->assertEquals($expected, $checkout->getTotal());
	}

	/**
	 * @test
	 * @dataProvider differentSkuItems
	 */
	public function get_total_with_different_sku_items(string $itemList, int $expected)
	{
		$checkout = new Checkout($this->getPriceTableA(), $this->getPriceCalculator());

		$checkout->scan($itemList);

		$this->assertEquals($expected, $checkout->getTotal());
	}

	/** @test */
	public function get_total_with_incremental_scanning()
	{
		$checkout = new Checkout($this->getPriceTableA(), $this->getPriceCalculator());

		$this->assertEquals(0, $checkout->getTotal());

		$checkout->scan('A');
		$this->assertEquals(50, $checkout->getTotal());

		$checkout->scan('B');
		$this->assertEquals(80, $checkout->getTotal());

		$checkout->scan('A');
		$this->assertEquals(130, $checkout->getTotal());

		$checkout->scan('A');
		$this->assertEquals(160, $checkout->getTotal());

		$checkout->scan('B');
		$this->assertEquals(175, $checkout->getTotal());

		$checkout->scan('BA');
		$this->assertEquals(255, $checkout->getTotal());
	}

	public function inputItems(): array
	{
		return [
			[
				'a',
				['A',],
			],
			[
				'a Bc',
				['A', ' ', 'B', 'C',],
			],
		];
	}

	public function sameSkuItems(): array
	{
		return [
			['', 0],
			['A', 50],
			['AA', 100],
			['AAA', 130],
			['AAAA', 180],
			['AAAAA', 230],
			['AAAAAA', 260],
		];
	}

	public function differentSkuItems(): array
	{
		return [
			['AAAB', 160],
			['AAABB', 175],
			['AAABBD', 190],
			['DABABA', 190],
			['CDBA', 115],
		];
	}

	public function getPriceCalculator(): PriceCalculator
	{
		return new PriceCalculator(new DiscountCalculatorFactory());
	}
}
