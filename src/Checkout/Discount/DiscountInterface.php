<?php

namespace App\Checkout\Discount;

interface DiscountInterface
{
	public function applicable(int $quantity): bool;
}