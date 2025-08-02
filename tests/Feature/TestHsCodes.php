<?php

namespace Tests\Feature;

use NerdZero\HsCodes\HsCodes as BaseHsCodes;

class TestHsCodes extends BaseHsCodes
{
    public function __construct()
    {
        $this->lookup = new TestHsCodeData()->getData();
    }
} 