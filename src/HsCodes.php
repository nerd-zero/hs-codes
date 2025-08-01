<?php

namespace NerdZero\HsCodes;

use RuntimeException;

class HsCodes
{
    protected array $lookup = [];
    protected string $dataFile;

    public function __construct(?string $dataFile = null)
    {
        $this->dataFile = $dataFile ?? __DIR__ . '/data/hs_codes.csv';

        if (!file_exists($this->dataFile)) {
            throw new RuntimeException("HS Codes data file not found: {$this->dataFile}");
        }
    }

    protected function loadData(): void
    {
        if (!empty($this->lookup)) {
            return;
        }

        if (!is_readable($this->dataFile)) {
            throw new RuntimeException("HS Codes data file not readable: {$this->dataFile}");
        }

        if (($handle = fopen($this->dataFile, "r")) !== false) {
            try {
                // Skip header row
                fgetcsv($handle);

                while (($row = fgetcsv($handle)) !== false) {
                    if (count($row) >= 3) {
                        $code = trim($row[1]);
                        $description = trim($row[2]);

                        if (!empty($code) && !empty($description)) {
                            $this->lookup[$code] = new HsCodeItem($code, $description);
                        }
                    }
                }
            } finally {
                fclose($handle);
            }
        }
    }

    public function getCodes(): array
    {
        $this->loadData();
        return array_keys($this->lookup);
    }

    public function getDescription(string $code): ?string
    {
        $this->loadData();
        $code = trim($code);

        if ($this->lookup[$code]) {
            return $this->lookup[$code]->description;
        }

        return null;
    }

    public function getDescriptions(): array
    {
        $this->loadData();
        return array_map(fn($item) => $item->description, $this->lookup);
    }

    public function getLookup(): array
    {
        $this->loadData();
        return $this->lookup;
    }
}