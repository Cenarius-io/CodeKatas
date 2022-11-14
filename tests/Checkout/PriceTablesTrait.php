<?php

namespace App\Tests\Checkout;

use App\Checkout\Discount\FixedPriceDiscount;
use App\Checkout\PriceTable;

trait PriceTablesTrait
{
	public function getPriceTableA(): PriceTable
	{
		$priceTable = new PriceTable();

		$priceTable->addPrice('A', 50);
		$discount = new FixedPriceDiscount(3, 130);
		$priceTable->addDiscount('A', $discount);

		$priceTable->addPrice('B', 30);
		$discount = new FixedPriceDiscount(2, 45);
		$priceTable->addDiscount('B', $discount);

		$priceTable->addPrice('C', 20);

		$priceTable->addPrice('D', 15);

		return $priceTable;
	}

	public function getPriceTableB(): PriceTable
	{
		$priceTable = new PriceTable();

		$priceTable->addPrice('A', 50);
		$priceTable->addPrice('B', 30);
		$priceTable->addPrice('C', 20);
		$priceTable->addPrice('D', 15);

		return $priceTable;
	}
}