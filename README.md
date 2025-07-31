# HS Codes PHP Library
```

A simple PHP library for working with Harmonized System (HS) codes and their descriptions.

## Installation

Install via Composer:

```bash
composer require nerdzero/hs-codes
```

## Usage

```php
use NerdZero\HsCodes\HsCodes;

// Get all HS codes
$allCodes = HsCodes::getCodes();

// Get description for a specific code
$description = HsCodes::getDescription('0101');

// Get all descriptions
$allDescriptions = HsCodes::getDescriptions();

// Get the full lookup array
$lookup = HsCodes::getLookup();
```

## Testing

Run tests with Pest:

```bash
./vendor/bin/pest
```

## Requirements

- PHP 8.0+