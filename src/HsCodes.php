<?php

namespace NerdZero\HsCodes;

use RuntimeException;

class HsCodes
{
    protected static array $lookup = [];
    protected static string $dataFile = __DIR__ . '/data/hs_codes.csv';

    public static function setDataFile(string $path): void
    {
        if (!file_exists($path)) {
            throw new \RuntimeException("HS Codes data file not found: $path");
        }
        self::$dataFile = $path;
        self::$lookup = [];
    }

    protected static function loadData(): void
    {
        if (!empty(self::$lookup)) return;

        if (!file_exists(self::$dataFile) || !is_readable(self::$dataFile)) {
            throw new RuntimeException("HS Codes data file not found or not readable: " . self::$dataFile);
        }

        if (($handle = fopen(self::$dataFile, "r")) !== false) {
            fgetcsv($handle);

            while (($row = fgetcsv($handle)) !== false) {
                if (count($row) >= 2) {
                    $code = trim($row[1]);
                    $description = trim($row[2] ?? '');

                    if (!empty($code) && !empty($description)) {
                        self::$lookup[$code] = $description;
                    }
                }
            }
            fclose($handle);
        }
    }

    public static function getCodes(): array
    {
        self::loadData();
        return self::$lookup;
    }

    public static function getDescription(string $code): ?string
    {
        self::loadData();
        return self::$lookup[trim($code)] ?? null;
    }

    public static function getDescriptions(): array
    {
        self::loadData();
        return array_values(self::$lookup);
    }

    public static function getLookup(): array
    {
        self::loadData();
        return self::$lookup;
    }
}