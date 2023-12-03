<?php

use App\Solutions\Day1;

test('Day1 returns the correct output when it\'s only numbers', function () {
    $day1 = new Day1(inputPath: __DIR__.'/../../input/day_1_test.txt');

    expect($day1->calculate())->toBe(142);
});

test('Day1 returns the correct output when it considers text numbers', function () {
    $day1 = new Day1(inputPath: __DIR__.'/../../input/day_1_test_2.txt', considerStrings: true);

    expect($day1->calculate())->toBe(281);
});
