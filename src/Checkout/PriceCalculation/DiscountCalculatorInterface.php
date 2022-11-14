<?php

namespace App\Checkout\PriceCalculation;

interface DiscountCalculatorInterface
{
	public function calculate(string $sku, int $quantity, int $unitPrice): int;
}