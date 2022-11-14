<?php

namespace App\Checkout\Discount;

class FixedPriceDiscount implements DiscountInterface
{
	public function __construct(public readonly int $discountQuantity, public readonly int $discountPrice)
	{
	}

	public function applicable(int $quantity): bool
	{
		return $quantity >= $this->discountQuantity;
	}
}