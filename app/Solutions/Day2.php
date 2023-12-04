<?php

namespace App\Solutions;

use App\DataTransferObjects\Color;
use Illuminate\Support\Collection;

class Day2
{
    public function __construct(
        public string $inputPath,
    ) {
    }

    public function calculatePart1(array $colors = []): int
    {
        return $this->getData()->filter(function ($game) use ($colors) {
            $isValid = true;

            foreach ($colors as $color) {
                $subset = collect($game['subsets'])->sortByDesc('amount')->where('name', $color->name)->first();

                if ($subset && $subset->amount > $color->amount) {
                    $isValid = false;
                    break;
                }
            }

            return $isValid;
        })->map(function ($game) {
            return (int) $game['id'];
        })->sum();
    }

    public function calculatePart2(array $colors = []): int
    {
        return $this->getData()->map(function ($game) use ($colors) {
            $values = collect([]);

            foreach ($colors as $color) {
                $subset = collect($game['subsets'])->sortByDesc('amount')->where('name', $color->name)->first();

                if ($subset) {
                    $values->add($subset->amount);
                }
            }

            return $values->reduce(function (?int $carry, int $item) {
                return $carry * $item;
            }, 1);
        })->sum();
    }

    private function getData(): Collection {
        return collect(explode(PHP_EOL, file_get_contents($this->inputPath)))->map(function ($game) {
            $game = explode(': ', $game);
            $id = explode('Game ', $game[0])[1];
            $subsets = collect(explode('; ', $game[1]))->map(function ($subset) {
                $subset = collect(explode(', ', $subset))->map(function ($color) {
                    $color = explode(' ', $color);
                    return new Color(name: $color[1], amount: (int) $color[0]);
                });

                return $subset;
            })->flatten();

            return compact('id', 'subsets');
        });
    }
}
