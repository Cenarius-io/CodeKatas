<?php

namespace App\Checkout\PriceCalculation;

use App\Checkout\Discount\DiscountInterface;
use App\Checkout\Discount\FixedPriceDiscount;

class DiscountCalculatorFactory
{
	public function getDiscountCalculator(?DiscountInterface $discount): ?DiscountCalculatorInterface
	{
		if (null === $discount) {
			return null;
		}

		return match ($discount::class ?? null) {
			FixedPriceDiscount::class => new FixedPriceDiscountCalculator($discount),
			default => throw new UnknownDiscountCalculator(),
		};
	}
}