SHELL := /bin/bash

tests:
	php vendor/bin/phpunit tests --testdox --colors

test-prime-factors:
	php vendor/bin/phpunit tests --testdox --colors --filter PrimeFactors

test-roman-numerals:
	php vendor/bin/phpunit tests --testdox --colors --filter RomanNumerals

test-missing-number:
	php vendor/bin/phpunit tests --testdox --colors --filter MissingNumber

.PHONY: tests