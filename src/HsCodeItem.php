<?php

namespace NerdZero\HsCodes;
readonly class HsCodeItem
{
    public function __construct(
        public string $code,
        public string $description
    ){}
}