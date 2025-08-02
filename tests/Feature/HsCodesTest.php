<?php

use Tests\Feature\TestHsCodes;

it('loads data from array', function () {
    $hsCodes = new TestHsCodes();
    $codes = $hsCodes->getCodes();
    
    expect($codes)->toBeArray()
        ->and(count($codes))->toBe(2);
});

it('correctly gets description by HS code', function () {
    $hsCodes = new TestHsCodes();
    
    expect($hsCodes->getDescription('12345'))->toBe('Test 1')
        ->and($hsCodes->getDescription('56789'))->toBe('Test 2')
        ->and($hsCodes->getDescription('nonexistent'))->toBeNull();
});

it('returns all descriptions', function () {
    $hsCodes = new TestHsCodes();
    $descriptions = $hsCodes->getDescriptions();
    
    expect($descriptions)->toBeArray()
        ->and(count($descriptions))->toBe(2)
        ->and($descriptions)->toContain('Test 1')
        ->and($descriptions)->toContain('Test 2');
});

it('returns complete lookup array', function () {
    $hsCodes = new TestHsCodes();
    $lookup = $hsCodes->getLookup();
    
    expect($lookup)->toBeArray()
        ->and(count($lookup))->toBe(2)
        ->and($lookup['12345'])->toBe('Test 1')
        ->and($lookup['56789'])->toBe('Test 2');
});