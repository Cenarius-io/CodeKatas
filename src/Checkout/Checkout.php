<?php

namespace App\Checkout;

use App\Checkout\PriceCalculation\PriceCalculator;

class Checkout
{
	private array $cart = [];

	public function __construct(
		private readonly PriceTableInterface $pricingTable,
		private readonly PriceCalculator $priceCalculator,
	) {
	}

	public function scan(string $items): void
	{
		if ($items === '') {
			return;
		}

		$this->cart = array_merge($this->cart, $this->formatItems($items));
	}

	public function formatItems(string $items): array
	{
		return str_split(strtoupper($items));
	}

	public function getTotal(): int
	{
		return $this->priceCalculator->calculateTotal($this->cart, $this->pricingTable);
	}
}