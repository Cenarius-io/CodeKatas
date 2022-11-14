<?php

namespace App\Checkout\PriceCalculation;

use App\Checkout\PriceTableInterface;

interface PriceCalculatorInterface
{
	public function calculateTotal(array $cart, PriceTableInterface $priceTable): int;

	public function getDiscountTotal(array $cart, PriceTableInterface $priceTable): int;
}