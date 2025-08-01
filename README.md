# HS Codes PHP Client

by [nerd-zero](https://packages.n0.rocks) – [n0.rocks](https://n0.rocks)

A PHP client library for working with Harmonized System (HS) codes and their descriptions. Reference [HS Codes](https://www.trade.gov/harmonized-system-hs-codes) for more details.

> ⚠️ **Warning**: This project is still a work in progress. APIs, features, and usage may change at any time without notice. Please use with caution and pin versions accordingly if used in production.

---

## Features

- Load HS codes from CSV files
- Retrieve code descriptions
- Search by HS code
- Type-safe with PHP 8.0+ features

## Installation

Install via Composer:

```bash
composer require nerd-zero/hs-codes
```

## Usage

### Basic Usage

```php
use NerdZero\HsCodes\HsCodes;

// Initialize with default data file
$hsCodes = new HsCodes();

// Get all HS codes
$allCodes = $hsCodes->getCodes();

// Get description for a specific code
$description = $hsCodes->getDescription('0101');

// Get all descriptions
$allDescriptions = $hsCodes->getDescriptions();

// Get the full lookup array (returns HsCodeItem objects)
$lookup = $hsCodes->getLookup();
```

### Custom Data File

```php
// Initialize with custom CSV file
$hsCodes = new HsCodes('/path/to/your/hs_codes.csv');
```

### Working with HsCodeItem Objects

```php
$lookup = $hsCodes->getLookup();

// Access individual items
$item = $lookup['0101'];
echo $item->code;
echo $item->description;
```

## Data File Format

The library expects a CSV file with the following format:
```
ITEM,HS CODE,GOODS DESCRIPTION
1,0101,Good Description 1
2,0102,Good Description 2
```

## Testing

Run tests with Pest:

```bash
./vendor/bin/pest
```

## Requirements

- PHP 8.0+
- Composer