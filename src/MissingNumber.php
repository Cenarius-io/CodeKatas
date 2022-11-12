<?php

namespace App;

class MissingNumber
{
	public static function getFirstMissingNumber(array $numbers): int
	{
		for ($i = 1; $i <= count($numbers); $i++) {

			if (!static::search($i, $numbers)) {
				return $i;
			}
		}

		return $i;
	}

	public static function search(int $needle, array $haystack): bool
	{
		if (in_array($needle, $haystack, true)) {
			return true;
		}

		return false;
	}
}