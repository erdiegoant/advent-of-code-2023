<?php

use App\DataTransferObjects\Color;
use App\Solutions\Day2;

test('Day2 returns the correct output for part 1', function () {
    $day2 = new Day2(inputPath: __DIR__.'/../../input/day_2_test.txt');
    $colors = [
        new Color(name: 'red', amount: 12),
        new Color(name: 'green', amount: 13),
        new Color(name: 'blue', amount: 14),
    ];

    expect($day2->calculatePart1($colors))->toBe(8);
});

test('Day2 returns the correct answer for part 2', function () {
    $day2 = new Day2(inputPath: __DIR__.'/../../input/day_2_test.txt');
    $colors = [
        new Color(name: 'red', amount: 12),
        new Color(name: 'green', amount: 13),
        new Color(name: 'blue', amount: 14),
    ];

    expect($day2->calculatePart2($colors))->toBe(2286);
});
