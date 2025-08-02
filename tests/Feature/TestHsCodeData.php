<?php

namespace Tests\Feature;

use NerdZero\HsCodes\Data\HsCodeData;

class TestHsCodeData extends HsCodeData
{
    public function getData(): array
    {
        return [
            "12345" => "Test 1",
            "56789" => "Test 2",
        ];
    }
} 