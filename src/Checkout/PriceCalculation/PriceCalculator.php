<?php

namespace App\Checkout\PriceCalculation;

use App\Checkout\PriceTableInterface;

class PriceCalculator implements PriceCalculatorInterface
{
	public function __construct(private readonly DiscountCalculatorFactory $discountCalculatorFactory)
	{
	}

	public function calculateTotal(array $cart, PriceTableInterface $priceTable): int
	{
		$total = 0;

		foreach ($cart as $sku) {
			$total += $priceTable->getPrice($sku);
		}

		return $total - $this->getDiscountTotal($cart, $priceTable);
	}

	public function getDiscountTotal(array $cart, PriceTableInterface $priceTable): int
	{
		$discountTotal = 0;

		foreach (array_count_values($cart) as $sku => $quantity) {

			$discountCalculator = $this->discountCalculatorFactory->getDiscountCalculator($priceTable->getDiscount($sku));

			$discountTotal += $discountCalculator?->calculate($sku, $quantity, $priceTable->getPrice($sku)) ?? 0;
		}

		return $discountTotal;
	}
}