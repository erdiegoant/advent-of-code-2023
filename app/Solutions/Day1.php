<?php

namespace App\Solutions;

use Illuminate\Support\Str;

readonly class Day1
{
    public function __construct(
        public string $inputPath,
        public bool $considerStrings = false,
    ) {
    }

    public function calculate(): int
    {
        $input = collect(explode(PHP_EOL, file_get_contents($this->inputPath)));
        $numbers = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

        return $input->map(function ($item) use ($numbers) {
            $changed = '';

            // Here I'll convert the numbers from strings to numbers
            if ($this->considerStrings && Str::contains($item, $numbers)) {
                $chars = str_split($item);

                foreach ($chars as $char) {
                    $changed .= $char;

                    foreach ($numbers as $index => $number) {
                        $changed = Str::replace($number, ($index + 1).$char, $changed);
                    }
                }

                $item = $changed;
            }

            $reversed = Str::reverse($item);

            $first = Str::match("/\d/", $item);
            $last = Str::match("/\d/", $reversed);

            $digits = $first.$last;

            return (int) $digits;
        })->sum();
    }
}
