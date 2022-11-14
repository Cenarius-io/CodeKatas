<?php

namespace App\Checkout\PriceCalculation;

use App\Checkout\Discount\DiscountInterface;

class FixedPriceDiscountCalculator implements DiscountCalculatorInterface
{
	public function __construct(private readonly ?DiscountInterface $discount)
	{
	}

	public function calculate(string $sku, int $quantity, int $unitPrice): int
	{
		if ($this->discount?->applicable($quantity)) {

			$multiplier = floor($quantity / $this->discount->discountQuantity);

			$originalPriceTotal = $this->discount->discountQuantity * $unitPrice;

			return ($originalPriceTotal - $this->discount->discountPrice) * $multiplier;
		}

		return 0;
	}
}