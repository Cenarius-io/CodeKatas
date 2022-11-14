<?php

namespace App\Checkout;

use App\Checkout\Discount\DiscountInterface;

class PriceTable implements PriceTableInterface
{
	private array $priceTable = [];

	public function getPrice(string $sku): int
	{
		return $this->priceTable[$sku]['unitPrice'] ?? throw new SkuNotFoundException();
	}

	public function addPrice(string $sku, int $unitPrice): self
	{
		$this->priceTable[$sku]['unitPrice'] = $unitPrice;

		return $this;
	}

	public function getDiscount(string $sku): ?DiscountInterface
	{
		return $this->priceTable[$sku]['discount'] ?? null;
	}

	public function addDiscount(string $sku, DiscountInterface $discount): PriceTableInterface
	{
		$this->priceTable[$sku]['discount'] = $discount;

		return $this;
	}

	public function hasDiscount(string $sku): bool
	{
		return isset($this->priceTable[$sku]['discount']) && $this->priceTable[$sku]['discount'] instanceof DiscountInterface;
	}
}