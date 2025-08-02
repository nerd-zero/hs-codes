<?php

namespace NerdZero\HsCodes;

use NerdZero\HsCodes\Data\HsCodeData;

class HsCodes
{
    protected array $lookup;

    public function __construct()
    {
        $this->lookup = new HsCodeData()->getData();
    }

    public function getCodes(): array
    {
        return array_keys($this->lookup);
    }

    public function getDescription(string $code): ?string
    {
        return $this->lookup[$code] ?? null;
    }

    public function getLookup(): array
    {
        return $this->lookup;
    }
    public function getDescriptions(): array
    {
        return array_values($this->lookup);
    }
}