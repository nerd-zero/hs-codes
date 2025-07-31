<?php

use NerdZero\HsCodes\HsCodes;

beforeEach(function () {
    $testFile = __DIR__ . '/data/hs_codes_fake.csv';
    HsCodes::setDataFile($testFile);
});

it('loads data from CSV file', function () {
    $codes = HsCodes::getCodes();

    var_dump($codes);
    expect($codes)->toBeArray()->toHaveCount(2);
});

it('correctly gets description by HS code', function () {
    expect(HsCodes::getDescription('12345'))->toBe('Test 1')
        ->and(HsCodes::getDescription('56789'))->toBe('Test 2')
        ->and(HsCodes::getDescription('99999'))->toBeNull();
});

it('returns all descriptions', function () {
    $descriptions = HsCodes::getDescriptions();
    expect($descriptions)->toBeArray()->toHaveCount(2)
        ->toContain('Test 1')
        ->toContain('Test 2');
});

it('returns complete lookup array', function () {
    $lookup = HsCodes::getLookup();
    expect($lookup)->toBeArray()->toHaveCount(2)
        ->toMatchArray([
            '12345' => 'Test 1',
            '56789' => 'Test 2'
        ]);
});

it('throws exception for missing file', function () {
    HsCodes::setDataFile('nonexistent_file.csv');
    HsCodes::getCodes();
})->throws(RuntimeException::class);