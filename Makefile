SHELL := /bin/bash

tests:
	php vendor/bin/phpunit tests --testdox --colors

test-checkout:
	php vendor/bin/phpunit tests --testdox --colors --filter Checkout

test-missing-number:
	php vendor/bin/phpunit tests --testdox --colors --filter MissingNumber

test-roman-numerals:
	php vendor/bin/phpunit tests --testdox --colors --filter RomanNumerals

test-prime-factors:
	php vendor/bin/phpunit tests --testdox --colors --filter PrimeFactors

.PHONY: tests