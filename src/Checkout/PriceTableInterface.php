<?php

namespace App\Checkout;

use App\Checkout\Discount\DiscountInterface;

interface PriceTableInterface
{
	public function getPrice(string $sku): int;

	public function addPrice(string $sku, int $unitPrice): self;

	public function getDiscount(string $sku): ?DiscountInterface;

	public function addDiscount(string $sku, DiscountInterface $discount): self;

	public function hasDiscount(string $sku): bool;
}