<?php

use NerdZero\HsCodes\HsCodeItem;
use NerdZero\HsCodes\HsCodes;

it('loads data from CSV file', function () {
    $codes = new HsCodes(__DIR__ . '/data/hs_codes_fake.csv')->getCodes();
    expect($codes)->toBeArray()->toHaveCount(2);
});

it('correctly gets description by HS code', function () {
    $hsCodes = new HsCodes(__DIR__ . '/data/hs_codes_fake.csv');

    printf($hsCodes->getDescription('12345'));

    expect($hsCodes->getDescription('12345'))->toBe('Test 1')
        ->and($hsCodes->getDescription('56789'))->toBe('Test 2')
        ->and($hsCodes->getDescription('99999'))->toBeNull();
});

it('returns all descriptions', function () {
    $descriptions = new HsCodes(__DIR__ . '/data/hs_codes_fake.csv')->getDescriptions();
    expect($descriptions)->toBeArray()->toHaveCount(2)
        ->toContain('Test 1')
        ->toContain('Test 2');
});

it('returns complete lookup array with HsCodeItem objects', function () {
    $lookup = new HsCodes(__DIR__ . '/data/hs_codes_fake.csv')->getLookup();
    expect($lookup)->toBeArray()->toHaveCount(2)
        ->and($lookup['12345'])->toBeInstanceOf(HsCodeItem::class)
        ->and($lookup['56789'])->toBeInstanceOf(HsCodeItem::class)
        ->and($lookup['12345']->description)->toBe('Test 1')
        ->and($lookup['56789']->description)->toBe('Test 2');
});

it('throws exception for missing file', function () {
    new HsCodes('nonexistent_file.csv')->getCodes();
})->throws(RuntimeException::class);