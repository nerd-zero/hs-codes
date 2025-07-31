<?php

namespace HsCodes;

class HsCodes
{
    protected static array $lookup = [];
    protected static function loadData(): void
    {
        if (!empty(self::$lookup)) return;

        $file = __DIR__ . '/data/hs_codes.csv';

        if (!file_exists($file) || !is_readable($file)) {
            throw new \RuntimeException("HS Codes data file not found or not readable: $file");
        }

        if (($handle = fopen($file, "r")) !== false) {
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

    /**
     * Get all HS codes and their descriptions.
     *
     * @return array An associative array of HS codes and their descriptions.
     */
    public static function getCodes(): array
    {
        self::loadData();
        return self::$lookup;
    }

    /**
     * Get the description for a specific HS code.
     *
     * @param string $code The HS code to look up.
     * @return string|null The description of the HS code, or null if not found.
     */
    public static function getDescription(string $code): ?string
    {
       self::loadData();
        $code = trim($code);
        return self::$lookup[$code] ?? null;
    }

    /**
     * Get all HS code descriptions.
     *
     * @return array An array of HS code descriptions.
     */
    public static function getDescriptions(): array
    {
        self::loadData();
        return array_values(self::$lookup);
    }

    /**
     * Get the lookup array of HS codes.
     *
     * @return array An associative array of HS codes and their descriptions.
     */
    public static function getLookup(): array
    {
        self::loadData();
        return self::$lookup;
    }
}