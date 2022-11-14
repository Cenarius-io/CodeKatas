<?php

namespace App\Tests\Checkout;

use App\Checkout\Discount\FixedPriceDiscount;
use App\Checkout\PriceTable;
use App\Checkout\PriceTableInterface;
use App\Checkout\SkuNotFoundException;
use PHPUnit\Framework\TestCase;

class PriceTableTest extends TestCase
{
	/** @test */
	public function it_should_implement_the_price_table_interface()
	{
		$priceTable = new PriceTable();

		$this->assertInstanceOf(PriceTableInterface::class, $priceTable);
	}

	/** @test */
	public function it_should_throw_an_sku_not_found_exception()
	{
		$this->expectException(SkuNotFoundException::class);

		$priceTable = new PriceTable();

		$priceTable->getPrice('A');
	}

	/**
	 * @test
	 * @dataProvider unitPrices
	 */
	public function it_should_return_the_proper_price(int $expectedPrice, string $sku, array $rules)
	{
		$priceTable = new PriceTable();

		foreach ($rules as $rule) {
			$priceTable->addPrice($rule['sku'], $rule['unitPrice']);
		}

		$this->assertEquals($expectedPrice, $priceTable->getPrice($sku));
	}

	/** @test */
	public function item_should_have_a_discount()
	{
		$sku = 'A';
		$priceTable = new PriceTable();
		$discount = new FixedPriceDiscount(3, 30);

		$priceTable
			->addPrice($sku, 50)
			->addDiscount($sku, $discount);

		$this->assertTrue($priceTable->hasDiscount($sku));
	}

	/** @test */
	public function item_should_not_have_any_discount()
	{
		$sku = 'A';
		$priceTable = new PriceTable();

		$priceTable
			->addPrice($sku, 50);

		$this->assertTrue(!$priceTable->hasDiscount($sku));
	}

	public function unitPrices(): array
	{
		return [
			[
				50,
				'A',
				[
					['sku' => 'A', 'unitPrice' => 50],
					['sku' => 'B', 'unitPrice' => 45],
				],
			],
			[
				25,
				'C',
				[
					['sku' => 'A', 'unitPrice' => 50],
					['sku' => 'B', 'unitPrice' => 45],
					['sku' => 'C', 'unitPrice' => 25],
					['sku' => 'D', 'unitPrice' => 15],
				],
			],
		];
	}
}
